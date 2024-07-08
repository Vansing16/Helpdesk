<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    
    public function customer()
    {
        // Fetch all users with the role of 'user'
        $customers = DB::table('users')->where('role', 'user')->get(); 
        return view('admin.customer', compact('customers')); // Return the view with customers data
    }

    public function view_customer($id)
    {
        // Fetch customer with tickets count
        $customer = DB::table('users')
            ->leftJoin('tickets', 'users.id', '=', 'tickets.customer_id')
            ->select('users.*', DB::raw('COUNT(tickets.id) as tickets_count'))
            ->where('users.id', $id)
            ->where('users.role', 'user')
            ->groupBy('users.id')
            ->first();

        if (!$customer) {
            return redirect()->route('admin.customer')->with('error', 'Customer not found');
        }

        return view('admin.customer.view_customer', compact('customer'));
    }

    public function delete_customer($id)
{
    // Fetch the customer by ID
    $customer = DB::table('users')->where('id', $id)->where('role', 'user')->first();

    if ($customer) {
        // Delete messages where the customer is involved
        DB::table('messages')
            ->where('customer_id', $id)
            ->orWhere('technician_id', $id)
            ->delete();

        // Delete related tickets first
        DB::table('tickets')->where('customer_id', $id)->delete();

        // Delete the customer
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('admin.customer')->with('success', 'Customer, related tickets, and messages deleted successfully');
    }

    return redirect()->route('admin.customer')->with('error', 'Customer not found');
}

    
}
