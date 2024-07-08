<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Technician;

class TechnicalController extends Controller
{
    public function index()
    {
        // Retrieve users with the role of technician and their ticket counts
        $users = DB::table('users')
            ->leftJoin('tickets', 'users.id', '=', 'tickets.technician_id')
            ->select('users.*', DB::raw('COUNT(tickets.id) as tickets_count'))
            ->where('users.role', 'technician')
            ->groupBy('users.id')
            ->get();

        return view('admin.technical', compact('users'));
    }

    public function addTechnical()
    {
        return view('admin.technical.add_technical');
    }

    public function storeTechnical(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'email_verified_at' => 'nullable|date', // This field is not required but can be set to 'nullable' if you want to allow 'null' values
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'nationality' => 'required|string',
            'status' => 'required|string|in:idle,online,offline',
            'imageInput' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Handle the file upload
        $profileImage = null;

        if ($request->hasFile('imageInput')) {
            $image = $request->file('imageInput');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $filePath = '/user_images/' . $fileName; // Define the path where the file will be stored in public directory

            // Move the uploaded file to the public directory
            $image->move(public_path('user_images'), $fileName);

            // Assign the file path to $profileImage
            $profileImage = $filePath;
        }

        // Create a new technician using the Technician model
        $technician = new Technician();
        $technician->name = $request->name;
        $technician->email = $request->email;
        $technician->password = Hash::make($request->password);
        $technician->phone = $request->phone;
        $technician->date_of_birth = $request->date_of_birth;
        $technician->nationality = $request->nationality;
        $technician->profile_image = $profileImage;
        $technician->status = $request->status;
        $technician->role = 'technician';
        $technician->created_at = now();
        $technician->updated_at = now();
        $technician->save();

        // Redirect back with success message
        return redirect()->route('admin.technical')->with('success', 'Technical added successfully');
    }

    public function viewTechnical($id)
    {
        $user = DB::table('users')
            ->leftJoin('tickets', 'users.id', '=', 'tickets.technician_id')
            ->select('users.*', DB::raw('COUNT(tickets.id) as tickets_count'))
            ->where('users.id', $id)
            ->where('users.role', 'technician')
            ->groupBy('users.id')
            ->first();

        if (!$user) {
            return redirect()->route('admin.technical')->with('error', 'User not found');
        }

        return view('admin.technical.view_technical', compact('user'));
    }

    public function editTechnical($id)
    {
        $user = DB::table('users')->where('id', $id)->where('role', 'technician')->first();
        if (!$user) {
            return redirect()->route('admin.user')->with('error', 'User not found');
        }
        return view('admin.technical.edit_technical', compact('user'));
    }

    public function updateTechnical(Request $request, $id)
    {
        // Find the technician by ID
        $technician = Technician::where('id', $id)->where('role', 'technician')->first();

        if (!$technician) {
            return redirect()->route('admin.user')->with('error', 'User not found');
        }

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:255|unique:users,email,' . $technician->id,
            'password' => 'nullable|string|min:8',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'nationality' => 'required|string',
            'status' => 'required|string|in:idle,online,offline',
            'imageInput' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Update the technician record
        $technician->name = $request->input('name');
        $technician->email = $request->input('email');
        $technician->phone = $request->input('phone');
        $technician->date_of_birth = $request->input('date_of_birth');
        $technician->nationality = $request->input('nationality');
        $technician->status = $request->input('status');
        $technician->updated_at = now();

        if ($request->filled('password')) {
            $technician->password = Hash::make($request->input('password'));
        }

        if ($request->hasFile('imageInput')) {
            $image = $request->file('imageInput');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $filePath = '/user_images/' . $fileName; // Define the path where the file will be stored in public directory

            // Move the uploaded file to the public directory
            $image->move(public_path('/user_images'), $fileName);

            // Delete the previous image if it exists
            if ($technician->profile_image) {
                $oldImagePath = public_path($technician->profile_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Delete the old profile image file
                }
            }

            // Update the technician's profile_image field with the new file path
            $technician->profile_image = $filePath;
            $technician->save();
        }


        $technician->save();

        // Redirect back with success message
        return redirect()->route('admin.technical')->with('success', 'Technician updated successfully');
    }

    public function deleteTechnical($id)
    {
        $user = DB::table('users')->where('id', $id)->where('role', 'technician')->first();
        if (!$user) {
            return redirect()->route('admin.user')->with('error', 'User not found');
        }

        if ($user->profile_image) {
            $imagePath = public_path($user->profile_image);

            // Check if the file exists before attempting to delete
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the profile image file
            }
        }

        // Delete messages where the technician is involved
        DB::table('messages')
            ->where('technician_id', $id)
            ->orWhere('customer_id', $id)
            ->delete();

        // Delete the corresponding user record from the users table
        DB::table('users')->where('id', $id)->delete();

        return redirect()->route('admin.technical')->with('success', 'Technician and associated messages deleted successfully.');
    }
}
