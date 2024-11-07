@extends('layouts.main')

@include('layouts.header')

@section('content')
<div class="page-heading">
    <h3>Create New Menu</h3>
</div>
<div class="col-lg-8">
    <form method="post" action="/dashboard/menus" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="id_level" class="form-label">id_level</label>
            <select class="form-select" name="id_level">
                @foreach($menu_levels as $menu_level)
                    @if(old('id_level') == $menu_level->id_level)
                        <option value="{{ $menu_level->id_level }}" selected>{{ $menu_level->id_level }}</option>
                    @else
                        <option value="{{ $menu_level->id_level }}">{{ $menu_level->id_level }}</option>
                    @endif
                @endforeach
            </select>
        </div>    
        <div class="mb-3">
            <label for="create_by" class="form-label">Create By</label>
            <select class="form-select" name="create_by">
                <option value="admin" {{ old('create_by') == 'admin' ? 'selected' : '' }}>admin</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="parent_id" class="form-label">parent_id</label>
            <input type="text" class="form-control @error('parent_id') is-invalid @enderror" id="parent_id"
                   name="parent_id" required autofocus value="{{ old('parent_id') }}">
            @error('parent_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="menu_name" class="form-label">Menu Name</label>
            <input type="text" class="form-control @error('menu_name') is-invalid @enderror" id="menu_name"
                   name="menu_name" required autofocus value="{{ old('menu_name') }}">
            @error('menu_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="menu_link" class="form-label">Menu Link</label>
            <input type="text" class="form-control @error('menu_link') is-invalid @enderror" id="menu_link" name="menu_link"
                   value="{{ old('menu_link') }}">
            @error('menu_link')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="menu_icon" class="form-label">Menu Icon</label>
            <input type="text" class="form-control @error('menu_icon') is-invalid @enderror" id="menu_icon" name="menu_icon"
                   value="{{ old('menu_icon') }}">
            @error('menu_icon')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>


        <button type="submit" class="btn btn-primary">Create Menu</button>
    </form>
</div>

@endsection
