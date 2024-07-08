@extends('admin.layout.master')
@section('title', 'Search Results')
@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Search Results</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(isset($tickets) && $tickets->count())
        <h2>Tickets</h2>
        @foreach ($tickets as $ticket)
            <div class="card shadow mb-2 {{ strtolower($ticket->status) == 'pending' ? 'border-left-warning' : (strtolower($ticket->status) == 'ongoing' ? 'border-left-success' : (strtolower($ticket->status) == 'completed' ? 'border-left-primary' : (strtolower($ticket->status) == 'cancelled' ? 'border-left-danger' : ''))) }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-2 mb-2 mb-md-0">
                            <strong class="d-md-none">Customer: </strong>
                            <a href="{{ route('admin.ticket.view_ticket', $ticket->id) }}" class="{{ str_contains(strtolower($ticket->customer_name), strtolower($search)) ? 'text-primary' : '' }}">
                                {{ $ticket->customer_name }}
                            </a>
                        </div>
                        <div class="col-12 col-md-3 mb-2 mb-md-0">
                            <strong class="d-md-none">Subject: </strong>
                            <a href="{{ route('admin.ticket.view_ticket', $ticket->id) }}" class="{{ str_contains(strtolower($ticket->subject), strtolower($search)) ? 'text-primary' : '' }}">
                                {{ $ticket->subject }}
                            </a>
                        </div>
                        <div class="col-6 col-md-1 mb-2 mb-md-0">
                            <strong class="d-md-none">Status: </strong>{{ $ticket->status }}
                        </div>
                        <div class="col-6 col-md-2 mb-2 mb-md-0">
                            <strong class="d-md-none">Assigned to: </strong>
                            <a href="{{ route('admin.ticket.view_ticket', $ticket->id) }}" class="{{ str_contains(strtolower($ticket->technician_name ?? ''), strtolower($search)) ? 'text-primary' : '' }}">
                                {{ $ticket->technician_name ?? 'N/A' }}
                            </a>
                        </div>
                        <div class="col-6 col-md-2 mb-2 mb-md-0">
                            <strong class="d-md-none">Date Posted: </strong>
                            <a href="{{ route('admin.ticket.view_ticket', $ticket->id) }}" class="{{ str_contains(strtolower($ticket->created_at), strtolower($search)) ? 'text-primary' : '' }}">
                                {{ $ticket->created_at }}
                            </a>
                        </div>                        
                        <div class="col-12 col-md-2 text-md-center">
                            <strong class="d-md-none">Action: </strong>
                            <a href="{{ route('admin.ticket.view_ticket', $ticket->id) }}"><i class="bi bi-eye" style="color:blue"></i></a>
                            <a href="{{ route('admin.ticket.edit_ticket', $ticket->id) }}"><i class="bi bi-pencil-square" style="color:green"></i></a>
                            <a href="{{ route('admin.ticket.delete_ticket', $ticket->id) }}"><i class="bi bi-trash" style="color:red"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @if(isset($technicians) && $technicians->count())
        <h2>Technicians</h2>
        @foreach ($technicians as $technician)
            <div class="card shadow mb-2 {{ strtolower($technician->status) == 'online' ? 'border-left-success' : (strtolower($technician->status) == 'offline' ? 'border-left-danger' : (strtolower($technician->status) == 'idle' ? 'border-left-warning' : '')) }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-2 mb-2 mb-md-0">
                            <strong class="d-md-none">ID: </strong>
                            <a href="{{ route('admin.technical.view_technical', $technician->id) }}" class="{{ str_contains($technician->id, $search) ? 'text-primary' : '' }}">
                                {{ $technician->id }}
                            </a>
                        </div>
                        <div class="col-12 col-md-2 mb-2 mb-md-0">
                            <strong class="d-md-none">Name: </strong>
                            <a href="{{ route('admin.technical.view_technical', $technician->id) }}" class="{{ str_contains(strtolower($technician->name), strtolower($search)) ? 'text-primary' : '' }}">
                                {{ $technician->name }}
                            </a>
                        </div>
                        <div class="col-12 col-md-2 mb-2 mb-md-0">
                            <strong class="d-md-none">Email: </strong>
                            <a href="{{ route('admin.technical.view_technical', $technician->id) }}" class="{{ str_contains(strtolower($technician->email), strtolower($search)) ? 'text-primary' : '' }}">
                                {{ $technician->email }}
                            </a>
                        </div>
                        <div class="col-12 col-md-2 mb-2 mb-md-0">
                            <strong class="d-md-none">Phone: </strong>
                            <a href="{{ route('admin.technical.view_technical', $technician->id) }}" class="{{ str_contains($technician->phone, $search) ? 'text-primary' : '' }}">
                                {{ $technician->phone }}
                            </a>
                        </div>
                        <div class="col-12 col-md-2 mb-2 mb-md-0">
                            <strong class="d-md-none">Status: </strong>{{ $technician->status }}
                        </div>
                        <div class="col-12 col-md-2 text-md-center">
                            <strong class="d-md-none">Action: </strong>
                            <a href="{{ route('admin.technical.view_technical', $technician->id) }}"><i class="bi bi-eye" style="color:blue"></i></a>
                            <a href="{{ route('admin.technical.edit_technical', $technician->id) }}"><i class="bi bi-pencil-square" style="color:green"></i></a>
                            <a href="{{ route('admin.technical.delete_technical', $technician->id) }}"><i class="bi bi-trash" style="color:red"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @if(isset($customers) && $customers->count())
        <h2>Customers</h2>
        @foreach ($customers as $customer)
            <div class="card shadow mb-2 {{ strtolower($customer->status) == 'online' ? 'border-left-success' : (strtolower($customer->status) == 'offline' ? 'border-left-danger' : (strtolower($customer->status) == 'idle' ? 'border-left-warning' : '')) }}">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-2 mb-2 mb-md-0">
                            <strong class="d-md-none">ID: </strong>
                            <a href="{{ route('admin.customer.view_customer', $customer->id) }}" class="{{ str_contains($customer->id, $search) ? 'text-primary' : '' }}">
                                {{ $customer->id }}
                            </a>
                        </div>
                        <div class="col-12 col-md-2 mb-2 mb-md-0">
                            <strong class="d-md-none">Name: </strong>
                            <a href="{{ route('admin.customer.view_customer', $customer->id) }}" class="{{ str_contains(strtolower($customer->name), strtolower($search)) ? 'text-primary' : '' }}">
                                {{ $customer->name }}
                            </a>
                        </div>
                        <div class="col-12 col-md-2 mb-2 mb-md-0">
                            <strong class="d-md-none">Email: </strong>
                            <a href="{{ route('admin.customer.view_customer', $customer->id) }}" class="{{ str_contains(strtolower($customer->email), strtolower($search)) ? 'text-primary' : '' }}">
                                {{ $customer->email }}
                            </a>
                        </div>
                        <div class="col-12 col-md-2 mb-2 mb-md-0">
                            <strong class="d-md-none">Phone: </strong>
                            <a href="{{ route('admin.customer.view_customer', $customer->id) }}" class="{{ str_contains($customer->phone, $search) ? 'text-primary' : '' }}">
                                {{ $customer->phone }}
                            </a>
                        </div>
                        <div class="col-12 col-md-2 text-md-center">
                            <strong class="d-md-none">Action: </strong>
                            <a href="{{ route('admin.customer.view_customer', $customer->id) }}"><i class="bi bi-eye" style="color:blue"></i></a>
                            <a href="{{ route('admin.customer.delete_customer', $customer->id) }}"><i class="bi bi-trash" style="color:red"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

    @if((!isset($tickets) || $tickets->count() == 0) && (!isset($technicians) || $technicians->count() == 0) && (!isset($customers) || $customers->count() == 0))
        <div class="alert alert-warning">No results found.</div>
    @endif
</div>
@endsection