@extends('layouts.main')

@include('layouts.header')

@section('content')
<div class="page-heading">
    <h3>Edit Profile</h3>
</div>
<div class="col-lg-8">
    <form method="POST" action="/dashboard/profile/{{ $user->id_user }}" class="mb-5" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                   name="email" required autofocus value="{{  old('email',$user->email) }}">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                   name="name" required autofocus value="{{  old('name',$user->name) }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                   name="username" required autofocus value="{{ old('username',$user->username) }}">
            @error('username')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">User Profile</label>
            <img class="img-preview img-fluid mb-3 col-sm-5">
            <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                   name="image" onchange="previewImage()">
            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
