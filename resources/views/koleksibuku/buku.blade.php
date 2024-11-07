@extends('layouts.main')

@include('layouts.header')

@section('content')
    <div class="page-heading">
        <h3> Koleksi Buku </h3>
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

                    <div id="bukuForm">
                        <form method="post" action="/dashboard/buku" class="mb-5" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="kode" class="form-label">Kode Buku</label>
                                <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                    id="kode" name="kode" required autofocus value="{{ old('kode') }}">
                                @error('kode')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Buku</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                    id="judul" name="judul" required autofocus value="{{ old('judul') }}">
                                @error('judul')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pengarang" class="form-label">Pengarang</label>
                                <input type="text" class="form-control @error('pengarang') is-invalid @enderror"
                                    id="pengarang" name="pengarang" required autofocus value="{{ old('pengarang') }}">
                                @error('pengarang')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select" name="id_kategori">
                                    @foreach ($kategori as $kategori)
                                        <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambahkan Kategori</button>
                        </form>
                    </div>

                    <div id="bukuTable">
                        <table id="myTable" class="table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">id_buku</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Judul Buku</th>
                                    <th scope="col">Pengarang</th>
                                    <th scope="col">Kategori</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($buku as $item)
                                    <tr>
                                        <td>{{ $item->id_buku }}</td>
                                        <td>{{ $item->kode }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{{ $item->pengarang }}</td>
                                        <td>{{ $item->kategori->nama_kategori }}</td>
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
