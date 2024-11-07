@extends('layouts.main')

@include('layouts.header')

@section('content')
    <div class="page-heading">
        <h3 id='header'> Setting Menu </h3>
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

                    <!-- Initially show the menu setting table -->
                    <div id="menuSettingTable" class="menu-settings">
                        @foreach ($jenis_users as $jenis_user)
                            <div class="user-group" data-id="{{ $jenis_user->id_jenis_user }}">
                                <h5 style="font-weight: bold;">{{ $jenis_user->name }}</h5>
                                <div class="menu-checkboxes">
                                    @foreach ($menus as $menu)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input menu-checkbox"
                                                data-id="{{ $menu->menu_id }}"
                                                {{ $menu->isAccessibleFor($jenis_user) ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ $menu->menu_name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('change', '.menu-checkbox', function() {
            const menu_id = $(this).data('id');
            const isChecked = $(this).is(':checked');
            const id_jenis_user = $(this).closest('.user-group').data('id');

            const requestData = {
                _token: $('meta[name="csrf-token"]').attr('content'),
                id_jenis_user: id_jenis_user
            };

            if (isChecked) {
                // When the checkbox is checked, send a POST request to create a new setting
                $.ajax({
                    url: '/dashboard/settingmenu/' + menu_id,
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(requestData),
                    success: function(response) {
                        alert(response.message || 'New menu-user relation created successfully!');
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('An error occurred while adding the menu: ' + xhr.responseText);
                    }
                });
            } else {
                // When the checkbox is unchecked, send a DELETE request to remove the setting
                $.ajax({
                    url: '/dashboard/settingmenu/' + menu_id,
                    type: 'DELETE',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id_jenis_user: id_jenis_user // Include user type for identification
                    },
                    success: function(response) {
                        alert(response.message || 'Menu setting deleted successfully!');
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('An error occurred while removing the menu: ' + xhr.responseText);
                    }
                });
            }
        });
    </script>
@endsection
