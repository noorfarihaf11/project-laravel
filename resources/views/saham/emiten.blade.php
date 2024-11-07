@extends('layouts.main')

@include('layouts.header')

@section('content')
    <div class="page-heading">
        <h3 id="header"> Emiten </h3>
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
                    <div id="emitenTable">
                        <table id="myTable" class="table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">stock_kode</th>
                                    <th scope="col">stock_name</th>
                                    <th scope="col">shared</th>
                                    <th scope="col">sektor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($emitens as $emiten)
                                <tr>
                                    <td>{{ $emiten->stock_kode }}</td>
                                    <td>{{ $emiten->stock_name }}</td>
                                    <td>{{ $emiten->shared }}</td>
                                    <td>{{ $emiten->sektor }}</td>
                                </tr>
                            @endforeach                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize DataTables on the user table
            $('#myTable').DataTable();

            // Additional JavaScript for handling buttons can go here...
        });
    </script>
