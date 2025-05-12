<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index()
    {
        $orders = OrderDetail::with(['user', 'ticketOrders'])->get();

        return response()->json([
            'status' => 'success',
            'data' => $orders
        ]);
    }

    public function show($id)
    {
        $order = OrderDetail::with(['user', 'ticketOrders'])->find($id);

        if (!$order) {
            return response()->json([
                'status' => 'error',
                'message' => 'Order not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $order
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|exists:users,id',
            'order_time' => 'required|date',
            'status' => 'in:pending,paid,canceled'
        ]);

        $order = OrderDetail::create([
            'user_id' => $request->user_id,
            'order_time' => $request->order_time,
            'status' => $request->status ?? 'pending'
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $order->load('user')
        ], 201);
    }
}
