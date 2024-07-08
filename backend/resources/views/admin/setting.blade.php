@extends('admin.layout.master')
@section('title', 'Profile')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="p-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form class="user" method="POST" enctype="multipart/form-data" action="{{ route('admin.profile.update') }}">
            @csrf
            <div class="text-center">
                <img src="{{ asset(Auth::user()->profile_image) }}" id="profileImage" class="profile-image mb-4">
                <input type="file" class="form-control col-3 mx-auto" id="imageInput" name="profile_image" accept="image/*" onchange="loadImage(event)">
                @error('profile_image')
                    <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <small class="text-muted">Name</small>
                <input type="text" class="mb-0 form-control" id="name" name="name" value="{{ Auth::user()->name }}" placeholder="name" required>
                @error('name')
                    <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <small class="text-muted">Email</small>
                <input type="email" class="mb-0 form-control" id="email" name="email" value="{{ Auth::user()->email }}" placeholder="email" required>
                @error('email')
                    <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <small class="text-muted">New Password</small>
                <input type="password" class="mb-2 form-control" id="newPassword" name="newPassword" placeholder="Enter a new password">
                @error('newPassword')
                    <p class="alert alert-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <small class="text-muted">Confirm New Password</small>
                <input type="password" class="mb-2 form-control" id="confirmNewPassword" name="newPassword_confirmation" placeholder="Confirm new password">
            </div>
            <button type="submit" class="btn btn-dark">Save</button>
        </form>
        <br>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back to Home</a>
    </div>
</div>


@stop
@section('script')
    <script src="{{ asset('js/profile.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script>
    $(document).ready(function() {
            $('#newPassword, #confirmNewPassword').on('keyup', function () {
                if ($('#newPassword').val() == $('#confirmNewPassword').val()) {
                    $('#confirmNewPassword').removeClass('is-invalid');
                } else {
                    $('#confirmNewPassword').addClass('is-invalid');
                }
            });
        });
   </script>
@endsection