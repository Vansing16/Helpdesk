<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    
    public function ticket(Request $request)
    {
        $status = $request->input('status');

        $tickets = DB::table('tickets')
            ->leftJoin('users as customers', 'tickets.customer_id', '=', 'customers.id')
            ->leftJoin('users as technicians', 'tickets.technician_id', '=', 'technicians.id')
            ->select(
                'tickets.*',
                'customers.name as customer_name',
                'technicians.name as technician_name'
            );

            if ($status) {
                $tickets->where(DB::raw('LOWER(tickets.status)'), strtolower($status));
            }

        $tickets = $tickets->get();

        return view('admin.ticket', compact('tickets', 'status'));
    }

    public function view_ticket($id)
    {
        // Retrieve the ticket details
        $ticket = DB::table('tickets')
            ->leftJoin('users as customers', 'tickets.customer_id', '=', 'customers.id')
            ->leftJoin('users as technicians', 'tickets.technician_id', '=', 'technicians.id')
            ->select(
                'tickets.*',
                'customers.name as customer_name',
                'technicians.name as technician_name'
            )
            ->where('tickets.id', $id)
            ->first();

        if (!$ticket) {
            return redirect()->route('admin.ticket')->with('error', 'Ticket not found');
        }

        // Retrieve the messages related to the ticket
        $messages = DB::table('messages')
            ->leftJoin('users as customers', 'messages.customer_id', '=', 'customers.id')
            ->leftJoin('users as technicians', 'messages.technician_id', '=', 'technicians.id')
            ->select(
                'messages.*',
                'customers.name as customer_name',
                'technicians.name as technician_name'
            )
            ->where('messages.ticket_id', $id)
            ->orderBy('messages.created_at', 'asc')
            ->get();

        // Manually construct the image URL for the ticket
        $imageUrl = $ticket->image ? url('ticket_images/' . $ticket->image) : null;

        return view('admin.ticket.view_ticket', compact('ticket', 'imageUrl', 'messages'));
    }

    public function edit_ticket($id)
    {
        $ticket = DB::table('tickets')
            ->leftJoin('users as customers', 'tickets.customer_id', '=', 'customers.id')
            ->leftJoin('users as technicians', 'tickets.technician_id', '=', 'technicians.id')
            ->select(
                'tickets.*',
                'customers.name as customer_name',
                'technicians.name as technician_name'
            )
            ->where('tickets.id', $id)
            ->first();

        if (!$ticket) {
            return redirect()->route('admin.ticket')->with('error', 'Ticket not found');
        }

        $technicians = DB::table('users')->where('role', 'technician')->get();

        return view('admin.ticket.edit_ticket', compact('ticket', 'technicians'));
    }

    public function update_ticket(Request $request, $id)
    {
        $request->validate([
            'technician_id' => 'required|exists:users,id',
        ]);

        $ticket = DB::table('tickets')->where('id', $id)->first();
        if (!$ticket) {
            return redirect()->route('admin.ticket')->with('error', 'Ticket not found');
        }

        DB::table('tickets')->where('id', $id)->update([
            'technician_id' => $request->input('technician_id'),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.ticket')->with('success', 'Ticket updated!');
    }

    public function delete_ticket($id)
    {
        $ticket = DB::table('tickets')->where('id', $id)->first();

        if (!$ticket) {
            return redirect()->route('admin.ticket')->with('error', 'Ticket not found');
        }

        DB::table('tickets')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Ticket deleted!');
    }
}
