<?php

namespace App\Http\Controllers;

use App\Models\TicketOrder;
use Illuminate\Http\Request;

class TicketOrderController extends Controller
{
    public function index()
    {
        $ticketOrders = TicketOrder::with(['ticket', 'orderDetail'])->get();

        return response()->json([
            'status' => 'success',
            'data' => $ticketOrders
        ]);
    }

    public function show($id)
    {
        $ticketOrder = TicketOrder::with(['ticket', 'orderDetail'])->find($id);

        if (!$ticketOrder) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ticket order not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $ticketOrder
        ]);
    }
}
