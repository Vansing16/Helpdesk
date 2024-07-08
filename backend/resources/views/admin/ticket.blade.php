@extends('admin.layout.master')
@section('title', 'Tickets')

@section('content')
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tickets</h1>
    </div>

    <form method="GET" action="{{ route('admin.ticket') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="">-- Select All --</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="ongoing" {{ request('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <div class="d-none d-md-flex row mx-1 mb-2">
        <div class="col-12 col-md-2 text-xs font-weight-bold text-uppercase">Customer</div>
        <div class="col-12 col-md-2 text-xs font-weight-bold text-uppercase">Subject</div>
        <div class="col-6 col-md-2 text-xs font-weight-bold text-uppercase">Status</div>
        <div class="col-6 col-md-2 text-xs font-weight-bold text-uppercase">Assigned To</div>
        <div class="col-6 col-md-2 text-xs font-weight-bold text-uppercase">Date Posted</div>
        <div class="col-12 col-md-2 text-xs font-weight-bold text-uppercase text-md-center">Action</div>
    </div>

    @foreach ($tickets as $ticket)
        <div class="card shadow mb-2 
            {{ strtolower($ticket->status) == 'pending' ? 'border-left-warning' : 
               (strtolower($ticket->status) == 'ongoing' ? 'border-left-success' : 
               (strtolower($ticket->status) == 'completed' ? 'border-left-primary' : 
               (strtolower($ticket->status) == 'cancelled' ? 'border-left-danger' : ''))) }}">
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
                        <strong class="d-md-none">Date Posted: </strong>{{ \Carbon\Carbon::parse($ticket->created_at)->format('Y-m-d') }}
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
</div>
@endsection
