@extends("layouts.main")

@include('layouts.header')

@section('content')
    <div class="page-heading">
        <h3>Users Activity</h3>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success col-lg-6" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="table-responsive col-lg-12">
                    <table class="table table-striped col-lg-12">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">ID User</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Time</th>
                                <th scope="col">Role</th>
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
                                    <td>
                                        @if ($user_activity->users->is_admin)
                                            Administrator
                                        @else
                                            User
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
