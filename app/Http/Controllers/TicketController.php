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
}
