@extends('layouts.main')

@include('layouts.header')

@section('content')
    <div class="page-heading">
        <h3 id="header">Dashboard Saham</h3>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-6" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <section class="row">
        <div class="col-12">
            <div class="row">
                <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
                <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
                <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
                <meta name="csrf-token" content="{{ csrf_token() }}">

                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Emiten</h5>
                                <h3>{{ $jumlah_emiten }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Volume Transaksi</h5>
                                <h3>{{ $volume_transaksi }}B</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Value Transaksi</h5>
                                <h3>{{ $value_transaksi }}T</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Frekuensi</h5>
                                <h3>{{ $jumlah_frekuensi }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="monthFilter" class="form-label">Pilih Bulan</label>
                    <select id="monthFilter" class="form-select">
                        <option value="">Semua Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                        @endfor
                    </select>
                </div>
                <table id="myTable" class="table display" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Stock Kode</th>
                            <th scope="col">Date of Transaction</th>
                            <th scope="col">Sum of Volume</th>
                            <th scope="col">Sum of Value</th>
                            <th scope="col">Sum of Frequency</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaksi_summary as $summary)
                            <tr data-month="{{ $summary['month'] }}">
                                <td>{{ $summary['stock_kode'] }}</td>
                                <td>{{ date('F', mktime(0, 0, 0, $summary['month'], 1)) }} {{ $summary['year'] }}</td>
                                <td>{{ number_format($summary['total_volume']) }}</td>
                                <td>{{ number_format($summary['total_value']) }}</td>
                                <td>{{ number_format($summary['total_frequency']) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <button id="download" class="btn btn-primary mb-3">Download PDF</button>

    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pie Value Transaksi</h5>
                    <canvas id="smallPieChart" width="300" height="300" style="width: 300px; height: 300px;"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Frekuensi Bulanan</h5>
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grafik Harga Close</h5>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Pie Chart
            var ctxSmallPie = document.getElementById('smallPieChart').getContext('2d');
            var smallPieChart = new Chart(ctxSmallPie, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($labels_pie) !!},
                    datasets: [{
                        data: {!! json_encode($data_pie) !!},
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                    }]
                },
                options: {
                    responsive: false,
                    maintainAspectRatio: false
                }
            });

            // Bar Chart
            var ctxBar = document.getElementById('barChart').getContext('2d');
            var barChart = new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labels_bar) !!},
                    datasets: [{
                        label: 'Frekuensi',
                        data: {!! json_encode($data_bar) !!},
                        backgroundColor: '#36A2EB'
                    }]
                }
            });

            // Line Chart
            var ctxLine = document.getElementById('lineChart').getContext('2d');
            var lineChart = new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: {!! json_encode($labels_line) !!},
                    datasets: [{
                        label: 'Harga Close',
                        data: {!! json_encode($data_line) !!},
                        borderColor: '#FF6384',
                        fill: false
                    }]
                }
            });

            // Inisialisasi DataTable
            var table = $('#myTable').DataTable();

            // Event listener untuk dropdown bulan
            $('#monthFilter').change(function() {
                var selectedMonth = $(this).val();

                // Tampilkan semua baris jika "Semua Bulan" dipilih
                if (selectedMonth === "") {
                    table.rows().every(function() {
                        var row = this.node();
                        $(row).show(); // Tampilkan semua row
                    });
                    table.draw(); // Refresh DataTable untuk menerapkan perubahan
                } else {
                    // Sembunyikan semua row
                    table.rows().every(function() {
                        var row = this.node();
                        var rowMonth = $(row).data('month'); // Ambil data-month dari setiap row

                        // Debugging
                        console.log("Filtering - Row Month: " + rowMonth + ", Selected Month: " + selectedMonth);

                        if (rowMonth == selectedMonth) {
                            $(row).show(); // Tampilkan row yang sesuai
                        } else {
                            $(row).hide(); // Sembunyikan row yang tidak sesuai
                        }
                    });

                    // Refresh DataTable untuk menerapkan filter
                    table.draw();
                }
            });

            // Download PDF
            document.getElementById('download').addEventListener('click', function() {
                const element = document.getElementById('myTable');
                html2pdf()
                    .from(element)
                    .save('laporan_bulanan.pdf');
            });
        });
    </script>
@endsection
