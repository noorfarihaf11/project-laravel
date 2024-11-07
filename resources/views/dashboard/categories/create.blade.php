@extends('layouts.main')

@include('layouts.header')

@section('content')
<div class="page-heading">
    <h3>Create New Category</h3>
</div>
<div class="col-lg-8">
    <form method="post" action="/dashboard/categories" class="mb-5" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                   name="name" required autofocus value="{{ old('name') }}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="text" class="form-control @error('color') is-invalid @enderror" id="color"
                   name="color" required autofocus value="{{ old('color') }}">
            @error('color')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Create Category</button>
    </form>
</div>
@endsection
