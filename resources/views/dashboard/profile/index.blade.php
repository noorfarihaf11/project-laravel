@extends('layouts.main')

@include('layouts.header')

@section('content')
<div class="page-heading">
    <h3>Profile User</h3>
</div>

@if(session()->has('success'))
<div class="alert alert-success" role="alert">
  {{ session ('success')}}
</div>
@endif

<div class="col-lg-8">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name"
               name="name" required value="{{ $user->name }}" readonly>
        <!-- Tampilkan pesan error jika ada -->
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username"
               name="username" required value="{{ $user->username }}" readonly>
        <!-- Tampilkan pesan error jika ada -->
        @error('username')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">email</label>
        <input type="email" class="form-control" id="email"
               name="email" required value="{{ $user->email }}" readonly>
        <!-- Tampilkan pesan error jika ada -->
        @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <a href="/dashboard/profile/{{ $user->id_user }}/edit" class="btn btn-primary mb-3">Edit User Profile</a>
</div>
@endsection
