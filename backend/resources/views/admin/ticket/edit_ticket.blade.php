@extends('admin.layout.master')
@section('title', 'Edit Ticket')
@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex  align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Ticket</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('admin.ticket.update_ticket', $ticket->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label for="technician_id">Assigned Technician</label>
                                <select name="technician_id" id="technician_id" class="mb-0 form-select form-control-sm toggle">
                                    <option value="">Select Technician</option>
                                    @foreach($technicians as $technician)
                                        @if($technician->status == 'online') <!-- Filter based on technician status -->
                                            <option value="{{ $technician->id }}" {{ $ticket->technician_id == $technician->id ? 'selected' : '' }}>{{ $technician->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary">Save</button>
                </form>
                
        </div>
    </div>
@stop            