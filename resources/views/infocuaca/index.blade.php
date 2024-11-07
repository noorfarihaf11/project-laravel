@extends('layouts.main')

@include('layouts.header')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Informasi Cuaca</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>

    <body>
        <div class="container mt-5">
            <h1 class="text-center">Informasi Cuaca</h1>
            <button id="loadData" class="btn btn-primary mb-3">Info Cuaca</button>
            <div id="sembunyikan" style="display:none;">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Informasi</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Datetime</th>
                            <td><span id="datetime"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">Suhu (°C)</th>
                            <td><span id="t"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">Kelembapan (%)</th>
                            <td><span id="hu"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">Kecepatan Angin (m/s)</th>
                            <td><span id="ws"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">Arah Angin (°)</th>
                            <td><span id="wd_deg"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">Arah Angin</th>
                            <td><span id="wd"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">Kondisi Cuaca</th>
                            <td><span id="weather_desc"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">Tanggal Analisis</th>
                            <td><span id="analysis_date"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">Gambar Cuaca</th>
                            <td id="image"></td>
                        </tr>
                        <tr>
                            <th scope="row">Waktu UTC</th>
                            <td><span id="utc_datetime"></span></td>
                        </tr>
                        <tr>
                            <th scope="row">Waktu Lokal</th>
                            <td><span id="local_datetime"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#loadData').click(function() {
                    $.ajax({
                        url: 'https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4=35.78.08.1003',
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data); // Log seluruh respons

                            $('#sembunyikan').fadeIn("slow");

                            // Akses data cuaca
                            let cuacaData = data.data[0].cuaca[0][0]; // Ambil cuaca dari elemen pertama

                            if (cuacaData) {
                                $('#datetime').html(cuacaData.datetime);
                                $('#t').html(cuacaData.t);
                                $('#hu').html(cuacaData.hu);
                                $('#ws').html(cuacaData.ws);
                                $('#wd_deg').html(cuacaData.wd_deg);
                                $('#wd').html(cuacaData.wd);
                                $('#weather_desc').html(cuacaData.weather_desc);
                                $('#analysis_date').html(cuacaData.analysis_date);
                                $('#image').html(`<img src="${cuacaData.image}" alt="Weather Image" class="img-fluid" />`);
                                $('#utc_datetime').html(cuacaData.utc_datetime);
                                $('#local_datetime').html(cuacaData.local_datetime);
                            } else {
                                alert('Data cuaca tidak tersedia.');
                            }
                        },
                        error: function(error) {
                            console.error("AJAX Error: ", error); // Log kesalahan
                            alert('Terjadi kesalahan dalam memuat data');
                        }
                    });
                });
            });
        </script>
    </body>
@endsection
