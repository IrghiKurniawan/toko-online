<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')->latest()->paginate(10);

        $orders = Order::paginate(10);

        return view('admin.order.index', compact('orders'));
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
}
