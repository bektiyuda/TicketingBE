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
}
