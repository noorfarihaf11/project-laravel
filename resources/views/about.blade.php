<x-layout>
  <x-slot:title>{{$nama}}</x-slot:title>
  <h3 class="text-xl"> Welcome to my About </h3>
</x-layout> 

@extends('layouts.main')

@section('content')
<div class="page-heading">
    <h3>Dashboard Saham</h3>
</div>

@if (session()->has('success'))
    <div class="alert alert-success col-lg-6" role="alert">
        {{ session('success') }}
    </div>
@endif

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

<div class="row mt-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Pie Value Transaksi</h5>
                <canvas id="pieChart"></canvas>
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

<div class="table-responsive mt-4">
    <table id="myTable" class="table table-striped">
        <thead>
            <tr>
                <th>Stock Code</th>
                <th>Date Transaction</th>
                <th>Volume</th>
                <th>Value</th>
                <th>Frequency</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksi_harian as $transaksi)
                <tr>
                    <td>{{ $transaksi->stock_code }}</td>
                    <td>{{ $transaksi->date_transaction }}</td>
                    <td>{{ $transaksi->volume }}</td>
                    <td>{{ $transaksi->value }}</td>
                    <td>{{ $transaksi->frequency }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pie Chart
    var ctxPie = document.getElementById('pieChart').getContext('2d');
    var pieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: {!! json_encode($labels_pie) !!},
            datasets: [{
                data: {!! json_encode($data_pie) !!},
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
            }]
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

    // Initialize DataTables
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>
@endsection
