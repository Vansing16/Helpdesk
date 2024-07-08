@extends('admin.layout.master')

@section('content')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/customer.css') }}">
@endsection

<div class="container-fluid">
    <div class="d-flex flex-row justify-content-md-between align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customer Details</h1>
    </div>

    <div class="card shadow mb-2 {{ strtolower($customer->status) == 'online' ? 'border-left-success' : (strtolower($customer->status) == 'offline' ? 'border-left-danger' : (strtolower($customer->status) == 'idle' ? 'border-left-warning' : '')) }}">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{ route('admin.customer.delete_customer', $customer->id) }}" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash-fill"></i> Delete
                    </a>
                    <a href="{{ route('admin.customer') }}" class="btn btn-secondary btn-sm ml-2">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-4 col-sm-12 text-center mb-3 mb-md-0">
                    <img src="{{ asset('storage/' . $customer->profile_image) }}" alt="Profile Image" class="img-thumbnail" style="box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px; border-radius: 2%; width: 400px; height: 400px; object-fit: cover;">
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="row mb-2">
                        <div class="col-12 col-md-4 font-weight-bold h5">ID:</div>
                        <div class="col-12 col-md-8 h5">{{ $customer->id }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12 col-md-4 font-weight-bold h5">Name:</div>
                        <div class="col-12 col-md-8 h5">{{ $customer->name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12 col-md-4 font-weight-bold h5">Email:</div>
                        <div class="col-12 col-md-8 h5">{{ $customer->email }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12 col-md-4 font-weight-bold h5">Phone Number:</div>
                        <div class="col-12 col-md-8 h5">{{ $customer->phone }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12 col-md-4 font-weight-bold h5">Status:</div>
                        <div class="col-12 col-md-8 h5">{{ $customer->status }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12 col-md-4 font-weight-bold h5">Ticket Sent:</div>
                        <div class="col-12 col-md-8 h5">{{ $customer->tickets_count }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@section('script')
    <script src="{{ asset('js/customer.js') }}"></script>
@endsection

@stop
