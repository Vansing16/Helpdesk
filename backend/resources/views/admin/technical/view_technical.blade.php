@extends('admin.layout.master')

@section('title', 'View Technician')
@section('content')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/agent.css') }}">
@endsection


<div class="container-fluid">
    <div class="d-flex flex-row justify-content-md-between align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Technician Details</h1>
        <a href="{{ route('admin.technical.add_technical') }}" class="btn mt-2 mt-md-0 text-white"
            style="background-color: black;">Add <i class="bi bi-person-fill-add"></i></a>
    </div>
    <div
        class="card shadow mb-2 card shadow {{ strtolower($user->status) == 'online' ? 'border-left-success' : (strtolower($user->status) == 'offline' ? 'border-left-danger' : (strtolower($user->status) == 'idle' ? 'border-left-warning' : '')) }}">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{ route('admin.technical.edit_technical', $user->id) }}"
                        class="btn btn-primary btn-sm mr-2">
                        <i class="bi bi-pencil-fill"></i> Edit
                    </a>
                    <a href="{{ route('admin.technical.delete_technical', $user->id) }}" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash-fill"></i> Delete
                    </a>
                    <a href="{{ route('admin.technical') }}" class="btn btn-secondary btn-sm ml-2">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-sm-12 text-center mb-3 mb-md-0">
                    <img src="{{ asset($user->profile_image) }}" alt="Profile Image" class="img-thumbnail"
                        style="box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px; border-radius: 2%; width: 400px; height: 400px; object-fit: cover;">

                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="row mb-2">
                        <div class="col-12 col-md-4 font-weight-bold h5">ID:</div>
                        <div class="col-12 col-md-8 h5">{{ $user->id }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12 col-md-4 font-weight-bold h5">Name:</div>
                        <div class="col-12 col-md-8 h5">{{ $user->name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12 col-md-4 font-weight-bold h5">Email:</div>
                        <div class="col-12 col-md-8 h5">{{ $user->email }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12 col-md-4 font-weight-bold h5">Date of Birth:</div>
                        <div class="col-12 col-md-8 h5">{{ $user->date_of_birth }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12 col-md-4 font-weight-bold h5">Nationality:</div>
                        <div class="col-12 col-md-8 h5">{{ $user->nationality }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12 col-md-4 font-weight-bold h5">Phone Number:</div>
                        <div class="col-12 col-md-8 h5">{{ $user->phone }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12 col-md-4 font-weight-bold h5">Status:</div>
                        <div class="col-12 col-md-8 h5">{{ $user->status }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12 col-md-4 font-weight-bold h5">Ticket Assigned:</div>

                        @if ($user->tickets_count > 0)
                            <div class="col-12 col-md-8 h5">{{ $user->tickets_count }}</div>
                        @else
                            <div class="col-12 col-md-8 h5">No tickets assigned.</div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Bootstrap Icons CDN if not already included -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">


</div>

@section('script')
    <script src="{{ asset('js/agent.js') }}"></script>
@endsection

@stop
