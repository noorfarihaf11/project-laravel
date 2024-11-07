@extends('layouts.main')

@include('layouts.header')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="page-heading">
        <h3>Tambah Kategori Baru</h3>
    </div>

    <div class="col-lg-8">
        <!-- Form untuk Add Kategori -->
        <div id="kategoriForm">
            <form method="post" action="/dashboard/kategori" class="mb-5" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="nama_kategori" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                        id="nama_kategori" name="nama_kategori" required autofocus value="{{ old('nama_kategori') }}">
                    @error('nama_kategori')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Tambahkan Kategori</button>
            </form>
        </div>

        {{-- <div id="editKategori" style="display: none;">
            <form id="updateKategori">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <input type="hidden" name="id_kategori" id="id_kategori">
                    <label for="editName" class="form-label">Kategori</label>
                    <input type="hidden" name="id_kategori" id="id_kategori">
                    <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="editName"
                        name="nama_kategori" required autofocus value="{{ old('nama_kategori') }}">
                    @error('nama_kategori')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Kategori</button>
            </form>
        </div> --}}

        <div class="page-heading">
            <h3>Kategori Buku</h3>
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
                        <table class="table table-striped col-lg-8">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Kategori</th>
                                    <th scope="col">Created At</th>
                                    {{-- <th scope="col">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori_buku as $kategori)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kategori->nama_kategori }}</td>
                                        <td>{{ $kategori->created_at }}</td>
                                        {{-- <td>
                                            <button class="badge bg-warning editButton" data-id="{{ $kategori->id }}"
                                                data-name="{{ $kategori->nama_kategori }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="badge bg-danger border-0"
                                                onclick="return confirm('Are you sure to delete this category?')">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                            </form>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.editButton', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');

            $('#id_kategori').val(id);
            $('#editName').val(name);
            $('#editKategori').fadeIn("slow");
            $('#kategoriForm').hide(); // Sembunyikan form tambah kategori
        });

        $('#updateKategori').on('submit', function(event) {
            event.preventDefault();

            const formData = $(this).serialize();
            const id_kategori = $('#id_kategori').val();

            console.log('Sending PUT request to:', '/dashboard/kategori/' + id_kategori);
            console.log('Data:', formData);

            $.ajax({
                url: '/dashboard/kategori/' + id_kategori,
                type: 'PUT',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        alert('Kategori berhasil diperbarui!');
                        location.reload();
                    } else {
                        alert('Error updating category: ' + (response.message || 'Unknown error.'));
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                    alert('Terjadi kesalahan saat memperbarui kategori: ' + xhr.responseText);
                }
            });
        });
    </script>
@endsection
