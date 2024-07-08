<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Retrieve inputs from the request
        $search = $request->input('search');
        $currentRouteName = Route::currentRouteName();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Ensure search term is at least two characters long unless it's a number with up to 3 digits
        if (!is_numeric($search) && preg_match('/[a-zA-Z]/', $search) && strlen($search) < 2) {
            return redirect()->back()->withErrors(['search' => 'Please enter at least 2 characters to search.']);
        }

        Log::info("Search term: $search");
        Log::info("Current route name: $currentRouteName");

        $tickets = collect();
        $technicians = collect();
        $customers = collect();

        if ($currentRouteName == 'admin.search') {
            // Search tickets

            $searchTerm = $search;
            $ticketsQuery = DB::table('tickets')
                ->leftJoin('users as customers', 'tickets.customer_id', '=', 'customers.id')
                ->leftJoin('users as technicians', 'tickets.technician_id', '=', 'technicians.id')
                ->select(
                    'tickets.*',
                    'customers.name as customer_name',
                    'technicians.name as technician_name'
                )
                ->where(function ($query) use ($searchTerm) {
                    $query->where(function ($query) use ($searchTerm) {
                        // Match first word from the beginning of the subject
                        $query->whereRaw('LOWER(tickets.subject) LIKE ?', [strtolower($searchTerm) . '%']);
                        $keywords = explode(' ', $searchTerm);
                        if (count($keywords) > 1) {
                            $lastWord = end($keywords);
                            $query->orWhereRaw('LOWER(tickets.subject) LIKE ?', [strtolower($searchTerm) . ' %']);
                        }
                    })
                    ->orWhere(function ($query) use ($searchTerm) {
                        // Search for customer or technician names starting with $searchTerm
                        $searchTermLower = strtolower($searchTerm);
                        $query->whereRaw('LOWER(customers.name) LIKE ?', [$searchTermLower . '%'])
                              ->orWhereRaw('LOWER(technicians.name) LIKE ?', [$searchTermLower . '%']);
                    });
                    

                    // Allow numeric search for ticket ID
                    if (is_numeric($searchTerm)) {
                        $query->orWhere('tickets.id', $searchTerm);
                    }
                });

            // Check for date and date range conditions
            if ($this->isValidDate($search)) {
                $ticketsQuery->orWhereDate('tickets.created_at', $search);
            } elseif ($this->isValidYearMonth($search)) {
                [$year, $month] = explode('-', $search);
                $ticketsQuery->whereYear('tickets.created_at', $year)
                    ->whereMonth('tickets.created_at', $month);
            }

            // Apply date range filter if both startDate and endDate are provided
            if ($startDate && $endDate) {
                $ticketsQuery->whereBetween('tickets.created_at', [Carbon::parse($startDate), Carbon::parse($endDate)]);
            }

            $tickets = $ticketsQuery->get();



            // Search technicians
            $technicians = DB::table('users')
                ->where('role', 'technician')
                ->where(function ($query) use ($search) {
                    $query->where(function ($query) use ($search) {
                        // Search for name starting with $search (case insensitive)
                        $query->whereRaw('LOWER(name) LIKE ?', [strtolower($search) . '%']);
                    })
                        ->orWhere('email', '=', $search) // Exact match for email
                        ->orWhere(function ($query) use ($search) {
                            // Numeric search for phone with three or more digits
                            if (is_numeric($search) && strlen($search) >= 3) {
                                // Clean the search term to only numeric characters and hyphens
                                $cleanSearch = preg_replace('/[^0-9\-]/', '', $search);
                                $query->whereRaw("REPLACE(REPLACE(phone, '-', ''), '-', '') LIKE ?", [$cleanSearch . '%']);
                            } else {
                                $query->where('phone', 'LIKE', $search . '%');
                            }
                        });

                    // Allow numeric search for ID
                    if (is_numeric($search)) {
                        $query->orWhere('id', $search);
                    }
                })
                ->get();

            $customers = DB::table('users')
                ->where('role', 'user')
                ->where(function ($query) use ($search) {
                    $query->where(function ($query) use ($search) {
                        // Search for name starting with $search (case insensitive)
                        $query->whereRaw('LOWER(name) LIKE ?', [strtolower($search) . '%']);
                    })
                        ->orWhere('email', '=', $search) // Exact match for email
                        ->orWhere(function ($query) use ($search) {
                            // Numeric search for phone with three or more digits
                            if (is_numeric($search) && strlen($search) >= 3) {
                                // Clean the search term to only numeric characters and hyphens
                                $cleanSearch = preg_replace('/[^0-9\-]/', '', $search);
                                $query->whereRaw("REPLACE(REPLACE(phone, '-', ''), '-', '') LIKE ?", [$cleanSearch . '%']);
                            } else {
                                $query->where('phone', 'LIKE', $search . '%');
                            }
                        });

                    // Allow numeric search for ID
                    if (is_numeric($search)) {
                        $query->orWhere('id', $search);
                    }
                })
                ->get();


            Log::info("Tickets found: " . $tickets->count());
            Log::info("Technicians found: " . $technicians->count());
            Log::info("Customers found: " . $customers->count());
        }

        return view('admin.search_results', compact('tickets', 'technicians', 'customers', 'search'));
    }

    private function isValidDate($date)
    {
        // Check if the date is in the correct format
        $d = \DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }

    private function isValidYearMonth($date)
    {
        // Check if the date is in the correct format for year-month
        $d = \DateTime::createFromFormat('Y-m', $date);
        return $d && $d->format('Y-m') === $date;
    }
}
