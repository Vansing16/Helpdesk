@extends('admin.layout.master')
@section('title', 'DashBoard')
@section('content')

    <div class="container-fluid">
        @if (session('login_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('login_message') }}
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('register_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('register_message') }}
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @php
            session()->forget('login_message');
            session()->forget('register_message');
        @endphp

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h1">DashBoard</h1>
        </div>

        <div class="row">
            <!-- Technicians Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Technicians</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $technicianCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-cog fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customers Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Customers</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $customerCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tickets Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tickets</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $ticketCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tickets Sent Today Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tickets Sent Today
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $ticketsSentTodayCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-day fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ticket Status Graph</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="ticketStatusChart" class="chart-container"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart for Ticket Assignment -->
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ticket Assignment</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-area">
                            <canvas id="ticketAssignmentChart" class="chart-container"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <h2 class="mb-4">Recent Tickets</h2>
                @foreach ($tickets as $ticket)
                    <div class="card shadow mb-2 {{ strtolower($ticket->status) == 'pending' ? 'border-left-warning' : (strtolower($ticket->status) == 'ongoing' ? 'border-left-success' : (strtolower($ticket->status) == 'completed' ? 'border-left-primary' : (strtolower($ticket->status) == 'cancelled' ? 'border-left-danger' : ''))) }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-2 mb-2 mb-md-0">
                                    <strong class="d-md-none">Customer: </strong>{{ $ticket->customer_name ?? 'N/A' }}
                                </div>
                                <div class="col-12 col-md-2 mb-3 mb-md-0">
                                    <strong class="d-md-none">Subject: </strong>{{ $ticket->subject }}
                                </div>
                                <div class="col-12 col-md-2 mb-3 mb-md-0">
                                    <strong class="d-md-none">Status: </strong>{{ $ticket->status }}
                                </div>
                                <div class="col-12 col-md-2 mb-2 mb-md-0">
                                    <strong class="d-md-none">Assigned to: </strong>{{ $ticket->technician_name ?? 'N/A' }}
                                </div>
                                <div class="col-12 col-md-2 mb-2 mb-md-0">
                                    <strong class="d-md-none">Date Posted: </strong>{{ \Carbon\Carbon::parse($ticket->created_at)}}
                                </div>
                                <div class="col-12 col-md-2 text-md-center">
                                    <strong class="d-md-none">Action: </strong>
                                    <a href="{{ route('admin.ticket.view_ticket', $ticket->id) }}"><i class="bi bi-eye"
                                            style="color:blue"></i></a>
                                    <a href="{{ route('admin.ticket.edit_ticket', $ticket->id) }}"><i class="bi bi-pencil-square"
                                            style="color:green"></i></a>
                                    <a href="{{ route('admin.ticket.delete_ticket', $ticket->id) }}"><i class="bi bi-trash"
                                            style="color:red"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var pendingCount = {{ $pendingCount }};
            var ongoingCount = {{ $ongoingCount }};
            var completedCount = {{ $completedCount }};
            var cancelledCount = {{ $cancelledCount }};

            var ctx = document.getElementById('ticketStatusChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar', // Use bar chart for better comparison
                data: {
                    labels: ['Pending', 'Ongoing', 'Completed', 'Cancelled'],
                    datasets: [{
                        // backgotunnd color for label
                        label: 'Ticket Status',
                        barPercentage: 0.5,
                        data: [pendingCount, ongoingCount, completedCount, cancelledCount, 0],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.8)', // Blue for Ongoing
                            'rgba(255, 206, 86, 0.8)', // Yellow for Completed
                            'rgba(255, 99, 132, 0.8)', // Red for Pending
                            'rgba(75, 192, 192, 0.8)', // Green for Cancelled
                            'rgba(153, 102, 255, 0.8)', // Purple for Assigned
                            'rgba(255, 159, 64, 0.8)' // Orange for Not Assigned
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)', // Border color for Ongoing
                            'rgba(255, 206, 86, 1)', // Border color for Completed
                            'rgba(255, 99, 132, 1)', // Border color for Pending
                            'rgba(75, 192, 192, 1)', // Border color for Cancelled
                            'rgba(153, 102, 255, 1)', // Border color for Assigned
                            'rgba(255, 159, 64, 1)' // Border color for Not Assigned
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            grid: {
                                display: false // Hide x-axis grid lines
                            },
                            ticks: {
                                font: {
                                    size: 12 // Font size for x-axis labels
                                }
                            }
                        },
                        y: {
                            ticks: {
                                font: {
                                    size: 12 // Font size for y-axis labels
                                },
                                stepSize: 1 // Increment by 1 since your data starts from 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false // Hide legend for simplicity
                        }
                    }
                }
            });
        });





        document.addEventListener('DOMContentLoaded', function() {
            // Pie Chart Data
            var assignedCount = {{ $ticketsAssignedCount }};
            var notAssignedCount = {{ $ticketsNotAssignedCount }};
            var ctx = document.getElementById('ticketAssignmentChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Assigned', 'Not Assigned'],
                    datasets: [{
                        label: 'Ticket Assignment',
                        data: [assignedCount, notAssignedCount],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)', // Changed color for Assigned
                            'rgba(54, 162, 235, 0.6)' // Changed color for Not Assigned
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            labels: {
                                color: 'rgb(75, 192, 192)' // Color for legend labels
                            }
                        }
                    }
                }
            });
        });
    </script>
@stop
