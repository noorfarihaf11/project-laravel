@extends('layouts.main')

@include('layouts.header')

@section('content')
    <div class="page-heading">
        <h3 id="header"> Master User </h3>
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

                    <link rel="stylesheet" type="text/css"
                        href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
                    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
                    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <!-- Buttons to toggle between views -->
                    <button id="addUser" class="btn btn-primary mb-3">New User</button>
                    <button id="seeUserActivity" class="btn btn-secondary mb-3">See User Activity</button>
                    <button id="backButton" class="btn btn-secondary mb-3" style="display: none;">Back</button>

                    <!-- User Table -->
                     <div id="userTable">
                        <table id="myTable" class="table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">id_user</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id_user }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->hasRole->name }}</td>
                                        <td>
                                            <button class="editButton badge bg-warning" data-id="{{ $user->id_user }}"
                                                data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                                data-username="{{ $user->username }}"
                                                data-jenis_user="{{ $user->id_jenis_user }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="deleteButton badge bg-danger" data-id="{{ $user->id_user }}">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="editForm" style="display: none;">
                        <form id="editUserForm">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="id_user" class="form-label">ID User</label>
                                <input type="text" class="form-control @error('id_user') is-invalid @enderror"
                                    id="id_user" name="id_user" required autofocus readonly>
                                @error('id_user')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" name="id_jenis_user">
                                    @foreach ($jenis_users as $jenis_user)
                                        <option value="{{ $jenis_user->id_jenis_user }}">{{ $jenis_user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </form>
                    </div>



                    <!-- User Form -->
                    <div id="userForm" style="display: none;">
                        <form method="POST" action="/dashboard/useroperations">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" required autofocus value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" required value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" required value="{{ old('username') }}">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select" name="id_jenis_user">
                                    @foreach ($jenis_users as $jenis_user)
                                        <option value="{{ $jenis_user->id_jenis_user }}">{{ $jenis_user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Add User</button>
                        </form>
                    </div>

                    <!-- User Activity Section -->
                    <div id="userActivity" style="display: none;">
                        <table class="table table-striped col-lg-12">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">ID User</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user_activities as $user_activity)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user_activity->users->username }}</td>
                                        <td>{{ $user_activity->users->id_user }}</td>
                                        <td>{{ $user_activity->description }}</td>
                                        <td>{{ $user_activity->status }}</td>
                                        <td>{{ $user_activity->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
            $('#addUser').click(function() {
                $('#header').text('Add New User');
                $('#userTable').hide();
                $('#userActivity').hide();
                $('#userForm').fadeIn("slow");
                $('#backButton').fadeIn("slow");
                $('#addUser').hide();
                $('#seeUserActivity').hide();
            });

            $('#seeUserActivity').click(function() {
                $('#header').text('Users Activity'); // Change header text
                $('#userTable').hide(); // Hide the user table
                $('#userForm').hide(); // Hide the user form
                $('#userActivity').fadeIn("slow"); // Show the user activity section
                $('#backButton').fadeIn("slow"); // Show the back button
                $('#addUser').hide(); // Hide the user table
                $('#seeUserActivity').hide(); // Hide the user activity section
            });

            $('#backButton').click(function() {
                $('#header').text('Users Operation'); // Change header text back
                $('#userTable').fadeIn("slow"); // Show the user table
                $('#userForm').hide(); // Hide the user form
                $('#userActivity').hide(); // Hide the user activity section
                $('#backButton').hide(); // Hide the back button
                $('#addUser').fadeIn("slow"); // Hide the user table
                $('#seeUserActivity').fadeIn("slow"); // Hide the user table
                $('#editForm').hide(); // Hide the back button
            });

            $(document).ready(function() {
                // Handle the edit button click
                $(document).on('click', '.editButton', function() {
                    // Ambil data dari tombol yang diklik
                    const id = $(this).data('id');
                    const name = $(this).data('name');
                    const email = $(this).data('email');
                    const username = $(this).data('username');
                    const id_jenis_user = $(this).data('id_jenis_user');

                    // Isi form dengan data yang diambil
                    $('#id_user').val(id);
                    $('#name').val(name);
                    $('#email').val(email);
                    $('#username').val(username);
                    $('#id_jenis_user').val(id_jenis_user);

                    // Tampilkan form edit
                    $('#header').text('Edit User');
                    $('#editForm').fadeIn("slow"); // Tampilkan form edit
                    $('#userTable').hide(); // Sembunyikan tabel pengguna
                    $('#userForm').hide(); // Sembunyikan form pengguna lain jika ada
                    $('#userActivity').hide(); // Sembunyikan aktivitas pengguna jika ada
                    $('#backButton').fadeIn("slow"); // Tampilkan tombol kembali jika ada
                    $('#addUser').hide(); // Sembunyikan tombol tambah pengguna jika ada
                    $('#seeUserActivity')
                        .hide(); // Sembunyikan tombol lihat aktivitas pengguna jika ada
                });

        

                // Back button handler
                $('#backButton').click(function() {
                    $('#header').text('Users Operation'); // Change header text back
                    $('#userTable').fadeIn("slow"); // Show the user table
                    $('#userForm').hide(); // Hide the user form
                    $('#userActivity').hide(); // Hide the user activity section
                    $('#backButton').hide(); // Hide the back button
                    $('#addUser').fadeIn("slow"); // Show the add user button
                    $('#seeUserActivity').fadeIn("slow"); // Show the see user activity button
                    $('#editForm').hide(); // Hide the edit form
                });
            });

            $('#editUserForm').on('submit', function(event) {
                event.preventDefault(); // Prevent page refresh

                const formData = $(this).serialize(); // Get all form data
                const id_user = $('#id_user').val(); // Get user ID from input

                $.ajax({
                    url: '/dashboard/useroperations/' + id_user, // Append user ID to the URL
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
                const id_user = $(this).data('id');
                const confirmed = confirm('Are you sure you want to delete this user?');

                if (confirmed) {
                    $.ajax({
                        url: '/dashboard/useroperations/' + id_user,
                        type: 'DELETE',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.success) {
                                alert('User deleted successfully!');
                                location.reload(); // Reload the page to update the table
                            } else {
                                alert('Error deleting user: ' + (response.message ||
                                    'Unknown error.'));
                            }
                        },
                        error: function(xhr) {
                            alert('An error occurred while deleting the user.');
                        }
                    });
                }
            });


        });
    </script>
@endsection
