<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderAdminController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);

        return view('admin.order.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled,',
        ]);

        $orders = order::findOrFail($id);

        // cegah status turun
        $flow = ['pending', 'processing', 'completed'];

        if (
            $orders->status !== 'cancel'
            && in_array($request->status, $flow)
            && array_search($request->status, $flow) < array_search($orders->status, $flow)
        ) {
            return back()->with('error', 'Status tidak boleh mundur ❌');
        }

        // STATUS DONE / CANCEL TIDAK BISA DIUBAH
        if (in_array($orders->status, ['done', 'cancel'])) {
            return back()->with('error', 'Order sudah final ⚠️');
        }

        $orders->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status order berhasil diperbarui ✅');
    }
}
