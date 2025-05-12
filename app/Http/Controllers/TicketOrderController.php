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

    public function store(Request $request)
    {
        $this->validate($request, [
            'ticket_id' => 'required|exists:tickets,id',
            'order_detail_id' => 'required|exists:order_details,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $ticketOrder = TicketOrder::create([
            'ticket_id' => $request->ticket_id,
            'order_detail_id' => $request->order_detail_id,
            'quantity' => $request->quantity
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $ticketOrder->load(['ticket', 'orderDetail'])
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $ticketOrder = TicketOrder::find($id);

        if (!$ticketOrder) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ticket order not found'
            ], 404);
        }

        $this->validate($request, [
            'ticket_id' => 'sometimes|exists:tickets,id',
            'order_detail_id' => 'sometimes|exists:order_details,id',
            'quantity' => 'sometimes|integer|min:1'
        ]);

        $ticketOrder->update($request->only(['ticket_id', 'order_detail_id', 'quantity']));

        return response()->json([
            'status' => 'success',
            'data' => $ticketOrder->load(['ticket', 'orderDetail'])
        ]);
    }
}
