@extends('admin.layout.master')

@section('title', 'Customers')
@section('content')

<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex flex-md-row justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customers</h1>
    </div>

    <div class="d-none d-md-flex row mx-1 mb-2">
        <div class="col-6 col-md-2 text-xs font-weight-bold text-uppercase">N.O</div>
        <div class="col-6 col-md-2 text-xs font-weight-bold text-uppercase">Name</div>
        <div class="col-6 col-md-2 text-xs font-weight-bold text-uppercase">Email</div>
        <div class="col-6 col-md-2 text-xs font-weight-bold text-uppercase">Phone</div>
        <div class="col-6 col-md-2 text-xs font-weight-bold text-uppercase">Status</div>
        <div class="col-6 col-md-2 text-xs font-weight-bold text-uppercase text-md-center">Action</div>
    </div>

    @foreach ($customers as $customer)
        <div class="card shadow mb-2 {{ strtolower($customer->status) == 'online' ? 'border-left-success' : (strtolower($customer->status) == 'offline' ? 'border-left-danger' : (strtolower($customer->status) == 'idle' ? 'border-left-warning' : '')) }}">
            <div class="card-body " >
                <div class="row">
                    <div class="col-12 col-md-2 mb-2 mb-md-0">
                        <strong class="d-md-none">NO: </strong>{{ $loop->iteration }}
                    </div>
                    <div class="col-12 col-md-2 mb-2 mb-md-0">
                        <strong class="d-md-none">Name: </strong>{{ $customer->name }}
                    </div>
                    <div class="col-12 col-md-2 mb-2 mb-md-0">
                        <strong class="d-md-none">Email: </strong>{{ $customer->email }}
                    </div>
                    <div class="col-12 col-md-2 mb-2 mb-md-0">
                        <strong class="d-md-none">Phone: </strong>{{ $customer->phone }}
                    </div>
                    <div class="col-6 col-md-2 mb-2 mb-md-0">
                        <strong class="d-md-none">Status: </strong>{{ $customer->status }}
                    </div>
                    <div class="col-6 col-md-2 text-md-center">
                        <strong class="d-md-none">Action: </strong>
                        <a href="{{ route('admin.customer.view_customer', $customer->id) }}"><i class="bi bi-eye" style="color:blue"></i></a>
                        <a href="{{ route('admin.customer.delete_customer', $customer->id) }}"><i class="bi bi-trash" style="color:red"></i></a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
