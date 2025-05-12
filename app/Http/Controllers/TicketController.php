<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('concert')->get();

        return response()->json([
            'status' => 'success',
            'data' => $tickets
        ]);
    }

    public function show($id)
    {
        $ticket = Ticket::with('concert')->find($id);

        if (!$ticket) {
            return response()->json([
                'status' => 'error',
                'message' => 'Ticket not found'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $ticket
        ]);
    }
}
