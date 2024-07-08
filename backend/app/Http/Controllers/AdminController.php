<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function index()
    {
        $technicianCount = DB::table('users')->where('role', 'technician')->count();
        $customerCount = DB::table('users')->where('role', 'user')->count();
        $ticketCount = DB::table('tickets')->count();
        $pendingRequestCount = DB::table('tickets')->where('status', 'Pending')->count();

        $pendingCount = DB::table('tickets')->where('status', 'Pending')->count();
        $ongoingCount = DB::table('tickets')->where('status', 'Ongoing')->count();
        $completedCount = DB::table('tickets')->where('status', 'Completed')->count();
        $cancelledCount = DB::table('tickets')->where('status', 'Cancelled')->count();

        $ticketsSentTodayCount = DB::table('tickets')->whereDate('created_at', Carbon::today())->count();

        $ticketsAssignedCount = DB::table('tickets')->whereNotNull('technician_id')->count();
        $ticketsNotAssignedCount = DB::table('tickets')->whereNull('technician_id')->count();

        $tickets = DB::table('tickets')
            ->leftJoin('users as customers', 'tickets.customer_id', '=', 'customers.id')
            ->leftJoin('users as technicians', 'tickets.technician_id', '=', 'technicians.id')
            ->select(
                'tickets.*',
                'customers.name as customer_name',
                'technicians.name as technician_name'
            )
            ->orderBy('tickets.created_at', 'desc')
            ->orderBy('tickets.id', 'desc')
            ->limit(3)
            ->get();

        return view('admin.dashboard', compact(
            'technicianCount',
            'customerCount',
            'ticketCount',
            'pendingRequestCount',
            'pendingCount',
            'ongoingCount',
            'completedCount',
            'cancelledCount',
            'ticketsSentTodayCount',
            'ticketsAssignedCount',
            'ticketsNotAssignedCount',
            'tickets'
        ));
    }

    public function setting()
    {
        return view('admin.setting');
    }

    public function Logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function profileUpdate(Request $request)
    {
        $id = auth()->user()->id;
        $user = User::find($id);

        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'profile_image' => 'nullable',
            'newPassword' => 'nullable|string|min:8|confirmed',
        ]);

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('profile_image')) {
            // Delete old profile image
            if ($user->profile_image) {
                // Get the path of the old profile image
                $oldImagePath = public_path($user->profile_image);

                // Check if the old image file exists before attempting to delete
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Delete the old profile image file
                }
            }

            // Store new profile image
            $image = $request->file('profile_image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $filePath = '/admin_images/' . $fileName; // Path where the file will be stored in public directory

            // Move the uploaded file to the public directory
            $image->move(public_path('/admin_images'), $fileName);

            // Update the user's profile_image field with the new file path
            $user->profile_image = $filePath;
            $user->save();
        }


        if ($request->newPassword) {
            $user->password = bcrypt($request->newPassword);
        }

        $user->save();

        return redirect()->route('admin.setting')->with('success', 'Profile updated successfully!');
    }
}
