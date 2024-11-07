@extends('layouts.main')

@include('layouts.header')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>AJAX Example</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>

    <body>
        <h1 id="h1">Informasi Gempa</h1>
        <button id="loadData" class="btn btn-primary mb-3">Info Gempa</button>
        <div id="sembunyikan" style="display:none;">
            <table class="table" style="text-align: left;">
                <thead>
                    <tr>
                        <th scope="col">Informasi</th>
                        <th scope="col">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Tanggal</th>
                        <td>: <span id="tanggal"></span></td>
                    </tr>
                    <tr>
                        <th scope="row">Jam</th>
                        <td>: <span id="jam"></span></td>
                    </tr>
                    <tr>
                        <th scope="row">Bujur</th>
                        <td>: <span id="bujur"></span></td>
                    </tr>
                    <tr>
                        <th scope="row">Coordinates</th>
                        <td>: <span id="coordinates"></span></td>
                    </tr>
                    <tr>
                        <th scope="row">DateTime</th>
                        <td>: <span id="datetime"></span></td>
                    </tr>
                    <tr>
                        <th scope="row">Dirasakan</th>
                        <td>: <span id="dirasakan"></span></td>
                    </tr>
                    <tr>
                        <th scope="row">Kedalaman</th>
                        <td>: <span id="kedalaman"></span></td>
                    </tr>
                    <tr>
                        <th scope="row">Lintang</th>
                        <td>: <span id="lintang"></span></td>
                    </tr>
                    <tr>
                        <th scope="row">Magnitude</th>
                        <td>: <span id="magnitude"></span></td>
                    </tr>
                    <tr>
                        <th scope="row">Potensi</th>
                        <td>: <span id="potensi"></span></td>
                    </tr>
                    <tr>
                        <th scope="row">Wilayah</th>
                        <td>: <span id="wilayah"></span></td>
                    </tr>
                    <tr>
                        <th scope="row">Kondisi</th>
                        <td>: <img id="gambar" alt="Kondisi Gempa"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <script>
            $(document).ready(function() {
                $('#loadData').click(function() {
                    $.ajax({
                        url: 'https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json',
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data); // Log the entire response
                            $('#sembunyikan').fadeIn("slow");
                            data = data.Infogempa.gempa;

                            console.log(data); // Log the specific data object

                            $('#tanggal').html(data.Tanggal);
                            $('#jam').html(data.Jam);
                            $('#gambar').attr('src', 'https://data.bmkg.go.id/DataMKG/TEWS/' + data
                                .Shakemap);
                            $('#bujur').html(data.Bujur);
                            $('#coordinates').html(data.Coordinates);
                            $('#datetime').html(data.DateTime);
                            $('#dirasakan').html(data.Dirasakan);
                            $('#kedalaman').html(data.Kedalaman);
                            $('#lintang').html(data.Lintang);
                            $('#magnitude').html(data.Magnitude);
                            $('#potensi').html(data.Potensi);
                            $('#wilayah').html(data.Wilayah);
                        },
                        error: function(error) {
                            console.error("AJAX Error: ", error); // Log the error
                            alert('Terjadi kesalahan dalam memuat data');
                        }
                    });
                });
            });
        </script>
    </body>
@endsection
