<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TicketReplyNotification;

class SupportTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user')->latest()->get();
        return view('admin.support-tickets.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::with(['user', 'messages.user'])->findOrFail($id);

        return view('admin.support-tickets.show', compact('ticket'));
    }

    public function reply(Request $request, Ticket $ticket)
    {
        $request->validate([
            'message' => 'required|string|min:5',
        ]);

        // Create the message from the current Admin
        $ticket->messages()->create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        $ticket->update(['status' => 'answered']);

        // Notify User
        $ticket->user->notify(new TicketReplyNotification($ticket, 'Admin'));

        return back()->with('success', 'Reply sent successfully.');
    }

    public function close(Ticket $ticket)
    {
        $ticket->update(['status' => 'closed']);

        // Notify User
        // $ticket->user->notify(new TicketStatusUpdated($ticket)); // Optional: Notify user of closure

        return back()->with('success', 'Ticket closed successfully.');
    }
}
