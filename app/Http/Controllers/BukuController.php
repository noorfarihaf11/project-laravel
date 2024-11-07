<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use App\Models\MenuUser;
use App\Models\Menu;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $menu_users = MenuUser::all();
        $menus = Menu::all();
        $buku = Buku::all();
        $kategori = KategoriBuku::all();
        return view('koleksibuku.buku', compact('buku', 'kategori','user','menu_users','menus'));
    }

    public function add_buku(Request $req){
        $buku = new Buku;
      
        $buku->kode = $req->post('kode');
        $buku->judul = $req->post('judul');
        $buku->pengarang= $req->post('pengarang');
        $buku->id_kategori= $req->post('id_kategori');
      
        $buku->save();
        return redirect('/dashboard/buku');
       }
}

