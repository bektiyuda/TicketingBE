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
}
