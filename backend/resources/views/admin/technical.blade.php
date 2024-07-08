@extends('admin.layout.master')
@section('title', 'Technicians')
@section('content')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/agent.css') }}">
@endsection

<div class="container-fluid">
    {{-- Add success message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="d-flex  flex-md-row justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Agents</h1>
        <a href="{{ route('admin.technical.add_technical') }}" class="btn mt-2 mt-md-0 text-white" style="background-color: black;">Add <i class="bi bi-person-fill-add"></i></a>
    </div>

    <div class="d-none d-md-flex row mx-1 mb-2">
        <div class="col-6 col-md-2 text-xs font-weight-bold text-uppercase">N.O</div>
        <div class="col-6 col-md-2 text-xs font-weight-bold text-uppercase">Name</div>
        <div class="col-6 col-md-2 text-xs font-weight-bold text-uppercase">Ticket</div>
        <div class="col-12 col-md-3 text-xs font-weight-bold text-uppercase">Email</div>
        <div class="col-6 col-md-1 text-xs font-weight-bold text-uppercase">Status</div>
        <div class="col-6 col-md-2 text-xs font-weight-bold text-uppercase text-md-center">Action</div>
    </div>

    @foreach ($users as $technician)
        <div class="card shadow mb-2 {{ strtolower($technician->status) == 'online' ? 'border-left-success' : (strtolower($technician->status) == 'offline' ? 'border-left-danger' : (strtolower($technician->status) == 'idle' ? 'border-left-warning' : '')) }}">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-2 mb-2 mb-md-0">
                        <strong class="d-md-none">NO: </strong>{{ $loop->iteration }}
                    </div>
                    <div class="col-12 col-md-2 mb-2 mb-md-0">
                        <strong class="d-md-none">First Name: </strong>{{ $technician->name }}
                    </div>
                    <div class="col-12 col-md-2 mb-2 mb-md-0">
                        <strong class="d-md-none">Ticket: </strong>{{ $technician->tickets_count }}
                    </div>
                    <div class="col-12 col-md-3 mb-2 mb-md-0">
                        <strong class="d-md-none">Email: </strong>{{ $technician->email }}
                    </div>
                    <div class="col-6 col-md-1 mb-2 mb-md-0">
                        <strong class="d-md-none">Status: </strong>{{ $technician->status }}
                    </div>
                    <div class="col-6 col-md-2 text-md-center">
                        <strong class="d-md-none">Action: </strong>
                        <a href="{{ route('admin.technical.view_technical', $technician->id) }}"><i class="bi bi-eye" style="color:blue"></i></a>
                        <a href="{{ route('admin.technical.edit_technical', $technician->id) }}"><i class="bi bi-pencil-square" style="color:green"></i></a>
                        <a href="{{ route('admin.technical.delete_technical', $technician->id) }}"><i class="bi bi-trash" style="color:red"></i></a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@section('script')
    <script src="{{ asset('js/agent.js') }}"></script>
@endsection

@stop
