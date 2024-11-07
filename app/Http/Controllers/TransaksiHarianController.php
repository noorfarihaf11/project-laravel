<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\MenuUser;
use App\Models\Menu;
use App\Models\Emiten;
use App\Models\TransaksiHarian;
use Carbon\Carbon;

class TransaksiHarianController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $menu_users = MenuUser::all();
        $menus = Menu::all();
        $emitens = Emiten::all();

        // Ambil semua transaksi dari 5 emiten
        $transaksi_harian = TransaksiHarian::whereIn('stock_kode', $emitens->pluck('stock_kode'))->get();

        // Inisialisasi array untuk summary
        $transaksi_summary = [];
        
        foreach ($transaksi_harian as $transaksi) {
            $month = Carbon::parse($transaksi->date_transaction)->format('n'); // Bulan (1-12)
            $year = Carbon::parse($transaksi->date_transaction)->format('Y'); // Tahun
            
            // Buat key untuk mengelompokkan
            $key = "{$transaksi->stock_kode}_{$year}_{$month}";

            if (!isset($transaksi_summary[$key])) {
                $transaksi_summary[$key] = [
                    'stock_kode' => $transaksi->stock_kode,
                    'month' => $month,
                    'year' => $year,
                    'total_volume' => 0,
                    'total_value' => 0,
                    'total_frequency' => 0,
                ];
            }

            // Tambahkan total
            $transaksi_summary[$key]['total_volume'] += $transaksi->volume;
            $transaksi_summary[$key]['total_value'] += $transaksi->value;
            $transaksi_summary[$key]['total_frequency'] += $transaksi->frequency;
        }

        // Mengubah array menjadi koleksi untuk mempermudah tampilan
        $transaksi_summary = array_values($transaksi_summary); // Mengubah kembali menjadi indexed array

        // Hitung total volume, value, dan frekuensi untuk semua transaksi
        $jumlah_emiten = Emiten::count();
        $volume_transaksi = TransaksiHarian::sum('volume');
        $value_transaksi = TransaksiHarian::sum('value');
        $jumlah_frekuensi = TransaksiHarian::sum('frequency');

        // Format angka untuk tampilan
        $volume_transaksi = $this->formatNumber($volume_transaksi);
        $value_transaksi = $this->formatNumber($value_transaksi);
        $jumlah_frekuensi = $this->formatNumber($jumlah_frekuensi);

        // Data untuk chart

        // Pie Chart: Ambil persentase total value untuk setiap emiten
        $pieData = TransaksiHarian::select('stock_kode', DB::raw('SUM(value) as total_value'))
            ->whereIn('stock_kode', ['ANTM', 'BBCA', 'BBRI', 'BRIS', 'GOTO'])
            ->groupBy('stock_kode')
            ->get();

        $labels_pie = $pieData->pluck('stock_kode')->toArray();
        $total_value = $pieData->sum('total_value');
        $data_pie = $pieData->map(function ($item) use ($total_value) {
            return $item->total_value / $total_value * 100; // Persentase nilai total per emiten
        })->toArray();

        // Bar Chart: Total volume per emiten
        $barData = TransaksiHarian::select('stock_kode', DB::raw('SUM(volume) as total_volume'))
            ->whereIn('stock_kode', ['ANTM', 'BBCA', 'BBRI', 'BRIS', 'GOTO'])
            ->groupBy('stock_kode')
            ->get();

        $labels_bar = $barData->pluck('stock_kode')->toArray();
        $data_bar = $barData->pluck('total_volume')->toArray();

        // Line Chart: Volume transaksi harian untuk bulan ini
        $lineData = TransaksiHarian::select(DB::raw('DAY(date_transaction) as day'), DB::raw('SUM(volume) as daily_volume'))
            ->whereMonth('date_transaction', Carbon::now()->month)
            ->whereYear('date_transaction', Carbon::now()->year)
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $labels_line = $lineData->pluck('day')->toArray();
        $data_line = $lineData->pluck('daily_volume')->toArray();

        return view('saham.transaksiharian', compact(
            'user',
            'menu_users',
            'menus',
            'emitens',
            'transaksi_harian',
            'jumlah_emiten',
            'volume_transaksi',
            'value_transaksi',
            'jumlah_frekuensi',
            'labels_pie',
            'data_pie',
            'labels_bar',
            'data_bar',
            'labels_line',
            'data_line',
            'transaksi_summary'
        ));
    }

    // Fungsi untuk memformat angka
    private function formatNumber($number)
    {
        if ($number >= 1000000000) {
            return number_format($number / 1000000000, 2) . ' Miliar';
        } elseif ($number >= 1000000) {
            return number_format($number / 1000000, 2) . ' Juta';
        } elseif ($number >= 1000) {
            return number_format($number / 1000, 2) . ' Ribu';
        }
        return $number; // Kembalikan angka asli jika kurang dari 1000
    }
}

