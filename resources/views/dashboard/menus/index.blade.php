@extends('layouts.main')

@include('layouts.header')

@section('content')
    <div class="page-heading">
        <h3 id='header'> Menu Users </h3>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-6" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <section class="row">

        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="table-responsive col-lg-12">

                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <link rel="stylesheet" type="text/css"
                        href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
                    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
                    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

                    <button id="addMenu" class="btn btn-primary mb-3">New Menu</button>
                    <button id="backButton" class="btn btn-secondary mb-3" style="display: none;">Back</button>

                    <div id="menuTable">
                        <table id="myTable" class="table display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">ID Menu</th>
                                        <th scope="col">Menu Name</th>
                                        <th scope="col">Menu Link</th>
                                        <th scope="col">Menu Icon</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menus as $menu)
                                        <tr>
                                            <td>{{ $menu->menu_id }}</td>
                                            <td>{{ $menu->menu_name }}</td>
                                            <td>{{ $menu->menu_link }}</td>
                                            <td>{{ $menu->menu_icon }}</td>
                                            <td>
                                                <button class="editButton badge bg-warning" data-id="{{ $menu->menu_id }}"
                                                    data-menu_name="{{ $menu->menu_name }}"
                                                    data-menu_link="{{ $menu->menu_link }}"
                                                    data-menu_icon="{{ $menu->menu_icon }}">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="deleteButton badge bg-danger"
                                                    data-id="{{ $menu->menu_id }}">
                                                    <i class="bi bi-x-circle"></i>
                                                </button>


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div>

                    <div id="editForm" style="display: none;">
                        <form id="editMenuForm">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="menu_id" class="form-label">ID Menu</label>
                                <input type="text" class="form-control @error('menu_id') is-invalid @enderror"
                                    id="menu_id" name="menu_id" required autofocus value="{{ old('menu_id') }}">
                                @error('menu_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="id_level" class="form-label">id_level</label>
                                <select class="form-select" name="id_level">
                                    @foreach ($menu_levels as $menu_level)
                                        @if (old('id_level') == $menu_level->id_level)
                                            <option value="{{ $menu_level->id_level }}" selected>
                                                {{ $menu_level->id_level }}</option>
                                        @else
                                            <option value="{{ $menu_level->id_level }}">{{ $menu_level->id_level }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="create_by" class="form-label">Create By</label>
                                <select class="form-select" name="create_by">
                                    <option value="admin" {{ old('create_by') == 'admin' ? 'selected' : '' }}>admin
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="menu_name" class="form-label">Menu Name</label>
                                <input type="text" class="form-control @error('menu_name') is-invalid @enderror"
                                    id="menu_name" name="menu_name" required autofocus value="{{ old('menu_name') }}">
                                @error('menu_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="menu_link" class="form-label">Menu Link</label>
                                <input type="text" class="form-control @error('menu_link') is-invalid @enderror"
                                    id="menu_link" name="menu_link" value="{{ old('menu_link') }}">
                                @error('menu_link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="menu_icon" class="form-label">Menu Icon</label>
                                <input type="text" class="form-control @error('menu_icon') is-invalid @enderror"
                                    id="menu_icon" name="menu_icon" value="{{ old('menu_icon') }}">
                                @error('menu_icon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update Menu</button>
                        </form>
                    </div>


                    <div id="menuForm" style="display: none;">
                        <form method="POST" action="/dashboard/menu">
                            @csrf
                            <div class="mb-3">
                                <label for="id_level" class="form-label">id_level</label>
                                <select class="form-select" name="id_level">
                                    @foreach ($menu_levels as $menu_level)
                                        @if (old('id_level') == $menu_level->id_level)
                                            <option value="{{ $menu_level->id_level }}" selected>
                                                {{ $menu_level->id_level }}</option>
                                        @else
                                            <option value="{{ $menu_level->id_level }}">{{ $menu_level->id_level }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="create_by" class="form-label">Create By</label>
                                <select class="form-select" name="create_by">
                                    <option value="admin" {{ old('create_by') == 'admin' ? 'selected' : '' }}>admin
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="menu_name" class="form-label">Menu Name</label>
                                <input type="text" class="form-control @error('menu_name') is-invalid @enderror"
                                    id="menu_name" name="menu_name" required autofocus value="{{ old('menu_name') }}">
                                @error('menu_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="menu_link" class="form-label">Menu Link</label>
                                <input type="text" class="form-control @error('menu_link') is-invalid @enderror"
                                    id="menu_link" name="menu_link" value="{{ old('menu_link') }}">
                                @error('menu_link')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="menu_icon" class="form-label">Menu Icon</label>
                                <input type="text" class="form-control @error('menu_icon') is-invalid @enderror"
                                    id="menu_icon" name="menu_icon" value="{{ old('menu_icon') }}">
                                @error('menu_icon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Create Menu</button>
                        </form>
                    </div>


                    <div id="manageMenu" style="display: none;">
                        <table class="table table-striped col-lg-12">
                            <thead>
                                <tr>
                                    <th scope="col">no_seting</th>
                                    <th scope="col">Jenis User</th>
                                    <th scope="col">Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($menu_users as $menu_user)
                                    <tr>
                                        <td>{{ $menu_user->no_seting }}</td>
                                        <td>{{ $menu_user->hasRole->name }}</td>
                                        <td>{{ $menu_user->menus->menu_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
    </div>


    </div>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            // Initialize DataTables on the user table
            $('#myTable').DataTable();

            // Additional JavaScript for handling buttons can go here...
        });

        $(document).ready(function() {
            $('#addMenu').click(function() {
                $('#header').text('Add New Menu');
                $('#menuTable').hide();
                $('#menuForm').fadeIn("slow");
                $('#backButton').fadeIn("slow");
                $(this).hide();
            });

            $('#seeManageMenu').click(function() {
                $('#header').text('Menu Management'); // Change header text
                $('#menuTable').hide(); // Hide the user table
                $('#addMenu, #seeManageMenu').hide();
                $('#menuForm').hide(); // Hide the user form
                $('#manageMenu').fadeIn("slow"); // Show the user activity section
                $('#backButton').fadeIn("slow"); // Show the back button
                $('#addManageMenu').fadeIn("slow"); // Show the back button
            });

            $('#addManageMenu').click(function() {
                $('#formManageMenu').fadeIn("slow"); // Show the back button
                $('#addMenu, #seeManageMenu, #addManageMenu').hide();
                $('#backButton').fadeIn("slow");
                $('#menuForm').hide();
                $('#menuTable').hide();
            });

            $('#backButton').click(function() {
                $('#header').text('Menu Management');
                $('#menuTable, #seeManageMenu').fadeIn("slow");
                $('#menuForm, #manageMenu, #editForm').hide();
                $(this).hide();
                $('#addMenu').fadeIn("slow");
            });

            $(document).on('click', '.editButton', function() {
                const id = $(this).data('id');
                const id_level = $(this).data('id_level');
                const create_by = $(this).data('create_by');
                const menu_name = $(this).data('menu_name');
                const menu_link = $(this).data('menu_link');
                const menu_icon = $(this).data('menu_icon');

                $('#menu_id').val(id);
                $('#id_level').val(id_level);
                $('#create_by').val(create_by);
                $('#menu_name').val(menu_name);
                $('#menu_link').val(menu_link);
                $('#menu_icon').val(menu_icon);

                $('#header').text('Edit Role');
                $('#editForm').fadeIn("slow");
                $('#menuTable, #menuForm').hide();
                $('#backButton, #addMenu').fadeIn("slow");
                $('#addMenu').fadeIn("slow");
            });

            $('#editMenuForm').on('submit', function(event) {
                event.preventDefault(); // Prevent page refresh

                const formData = $(this).serialize(); // Get all form data
                const menu_id = $('#menu_id').val(); // Ensure this is correctly set

                $.ajax({
                    url: '/dashboard/menu/' + menu_id, // Use the correct URL with menu_id
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            alert('Menu updated successfully!');
                            location.reload(); // Reload page to update the table
                        } else {
                            alert('Error updating menu: ' + (response.message ||
                                'Unknown error.'));
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred while updating the menu: ' + xhr.responseText);
                    }
                });
            });


            $(document).on('click', '.deleteButton', function() {
                const menu_id = $(this).data('id');
                const confirmed = confirm('Are you sure you want to delete this menu?');

                if (confirmed) {
                    $.ajax({
                        url: '/dashboard/menu/' + menu_id,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                alert('Menu deleted successfully!');
                                location.reload();
                            } else {
                                alert('Error deleting menu: ' + (response.message ||
                                    'Unknown error.'));
                            }
                        },
                        error: function() {
                            alert('An error occurred while deleting the menu.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
