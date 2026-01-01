<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewTicketCreated;
use App\Notifications\TicketReplyNotification;
use Illuminate\Support\Facades\Notification;

class SupportController extends Controller
{
    /**
     * Display a listing of the user's tickets.
     */
    public function index()
    {
        $tickets = Auth::user()->tickets()->latest()->get();
        return view('support.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new ticket.
     */
    public function create()
    {
        return view('support.create');
    }

    /**
     * Store a newly created ticket in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high',
            'message' => 'required|string',
        ]);

        $ticket = Auth::user()->tickets()->create([
            'subject' => $request->subject,
            'priority' => $request->priority,
            'status' => 'open',
        ]);

        // Add the initial message
        $ticket->messages()->create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        // Notify Admins
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new NewTicketCreated($ticket));

        return redirect()->route('support.index')->with('success', 'Ticket created successfully.');
    }

    /**
     * Display the specified ticket.
     */
    public function show(Ticket $ticket)
    {
        // Ensure the user owns the ticket
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        $ticket->load('messages.user');
        return view('support.show', compact('ticket'));
    }

    /**
     * Reply to a ticket.
     */
    public function reply(Request $request, Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        if ($ticket->status === 'closed') {
            return back()->with('error', 'This ticket is closed.');
        }

        $request->validate([
            'message' => 'required|string',
        ]);

        $ticket->messages()->create([
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        // Optionally update status to 'open' if it was closed or answered, 
        // to indicate user activity.
        if ($ticket->status !== 'open') {
            $ticket->update(['status' => 'open']);
        }

        // Notify Admins
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new TicketReplyNotification($ticket, Auth::user()->name));

        return redirect()->route('support.show', $ticket)->with('success', 'Reply posted.');
    }
}
