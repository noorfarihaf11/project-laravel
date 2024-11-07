<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuUser;
use App\Models\Menu;
use App\Models\Emiten;
use App\Models\TransaksiHarian;
use Illuminate\Support\Facades\DB;

class EmitenController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $menu_users = MenuUser::all();
        $menus = Menu::all();
        $emitens = Emiten::all();
        $transaksi_harian = TransaksiHarian::all();
        return view('saham.emiten', compact('user','menu_users','menus','emitens','transaksi_harian'));
    }

    public function store(Request $req){
        $emitens = new Emiten();
      
        $emitens->no_record = $req->post('stock_kode');
        $emitens->stock_kode = $req->post('stock_name');
        $emitens->date_transaction= $req->post('shared');
        $emitens->open= $req->post('sektor');
      
        $emitens->save();
        return redirect('/dashboard/emiten');
       }

       public function importEmiten()
       {
           // Ganti dengan path ke file CSV Anda
           $filePath = base_path('public/path_to_your_file.csv');
   
           $query = "
               LOAD DATA INFILE '{$filePath}'
               INTO TABLE nama_tabel
               FIELDS TERMINATED BY ',' 
               ENCLOSED BY '\"'
               LINES TERMINATED BY '\n'
               IGNORE 1 ROWS; -- Jika ada header
           ";
   
           try {
               DB::statement($query);
               return response()->json(['success' => 'Data imported successfully']);
           } catch (\Exception $e) {
               return response()->json(['error' => $e->getMessage()]);
           }
       }
}
