@extends('layouts.main')

@include('layouts.header')

@section('content')
    <div class="page-heading">
        <h3> Role Management </h3>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-6" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <section class="row">

        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="table-responsive col-lg-6">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <!-- Buttons to toggle between views -->
                    <button id="addRole" class="btn btn-primary mb-3">New Role</button>
                    <button id="backButton" class="btn btn-secondary mb-3" style="display: none;">Back</button>

                    <link rel="stylesheet" type="text/css"
                        href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
                    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
                    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
                    <!-- User Table -->
                    <div id="roleTable">
                        <table id="myTable" class="table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">id_role</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jenis_users as $jenis_user)
                                    <tr>
                                        <td>{{ $jenis_user->id_jenis_user }}</td>
                                        <td>{{ $jenis_user->name }}</td>
                                        <td>
                                            <button class="editButton badge bg-warning"
                                                data-id="{{ $jenis_user->id_jenis_user }}"
                                                data-name="{{ $jenis_user->name }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="deleteButton badge bg-danger"
                                                data-id="{{ $jenis_user->id_jenis_user }}">
                                                <i class="bi bi-x-circle"></i>
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="roleForm" style="display: none;">
                        <form method="POST" action="/dashboard/role">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Role</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" required autofocus value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Role</button>
                        </form>
                    </div>

                    <div id="editRoleForm" style="display: none;">
                        <form id="updateRole">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <input type="hidden" name="id_jenis_user" id="id_jenis_user">
                                <label for="editName" class="form-label">Role</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="editName" name="name" required autofocus value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update Role</button>
                        </form>
                    </div>


                </div>
    </section>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            // Initialize DataTables on the user table
            $('#myTable').DataTable();

            // Additional JavaScript for handling buttons can go here...
        });
        $(document).ready(function() {
            $('#addRole').click(function() {
                $('#header').text('Add New Role');
                $('#roleTable').hide();
                $('#roleForm').fadeIn("slow");
                $('#backButton').fadeIn("slow");
                $(this).hide();
            });

            $('#backButton').click(function() {
                $('#header').text('Role');
                $('#roleTable').fadeIn("slow");
                $('#roleForm, #editRoleForm').hide();
                $(this).hide();
                $('#addRole').fadeIn("slow");
            });

            $(document).on('click', '.editButton', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');

                $('#id_jenis_user').val(id);
                $('#editName').val(name); // Change to 'editName'

                $('#header').text('Edit Role');
                $('#editRoleForm').fadeIn("slow");
                $('#roleTable, #roleForm').hide();
                $('#backButton, #addRole').fadeIn("slow");
            });

            $('#updateRole').on('submit', function(event) {
                event.preventDefault(); // Prevent page refresh

                const formData = $(this).serialize(); // Get all form data
                const id_jenis_user = $('#id_jenis_user').val(); // Get user ID from input

                $.ajax({
                    url: '/dashboard/role/' + id_jenis_user, // Append user ID to the URL
                    type: 'PUT',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            alert('User updated successfully!');
                            location.reload(); // Reload page to update the table
                        } else {
                            alert('Error updating user: ' + (response.message ||
                                'Unknown error.'));
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr); // Log the complete error
                        alert('An error occurred while updating the user: ' + xhr.responseText);
                    }
                });
            });


            $(document).on('click', '.deleteButton', function() {
                const id_jenis_user = $(this).data('id');
                const confirmed = confirm('Are you sure you want to delete this role?');

                if (confirmed) {
                    $.ajax({
                        url: '/dashboard/role/' + id_jenis_user,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                alert('Role deleted successfully!');
                                location.reload();
                            } else {
                                alert('Error deleting role: ' + (response.message ||
                                    'Unknown error.'));
                            }
                        },
                        error: function() {
                            alert('An error occurred while deleting the role.');
                        }
                    });
                }
            });
        });
    </script>
@endsection
