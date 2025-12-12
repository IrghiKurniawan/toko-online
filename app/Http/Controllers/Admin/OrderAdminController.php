<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $orders = Order::with('items.product', 'user')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'LIKE', '%'.$search.'%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.order.index', compact('orders', 'search'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi status yang benar
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);

        // Alur status yang benar
        $flow = ['pending', 'processing', 'completed'];

        // Cegah status mundur (hanya berlaku selain cancelled)
        if (
            $order->status !== 'cancelled' &&
            in_array($request->status, $flow) &&
            array_search($request->status, $flow) < array_search($order->status, $flow)
        ) {
            return back()->with('error', 'Status tidak boleh mundur ❌');
        }

        // completed atau cancelled tidak boleh diubah
        if (in_array($order->status, ['completed', 'cancelled'])) {
            return back()->with('error', 'Order sudah final ⚠️');
        }

        // Update status
        $order->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status order berhasil diperbarui ✅');
    }

    public function destroy($id)
    {
        $orders = Order::findOrFail($id);
        $orders->delete();

        return redirect()->back()->with('success', 'berhasil menghapus data order');
    }
}
