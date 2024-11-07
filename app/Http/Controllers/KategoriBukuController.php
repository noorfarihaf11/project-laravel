<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\KategoriBuku;
use Illuminate\Http\Request;
use App\Models\MenuUser;
use App\Models\Menu;

class KategoriBukuController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $menu_users = MenuUser::all();
        $menus = Menu::all();
        $kategori_buku = KategoriBuku::all();
        $buku = Buku::all();
        return view('koleksibuku.kategori', compact('buku', 'kategori_buku', 'user', 'menu_users', 'menus'));
    }

    public function add_kategori(Request $req)
    {
        $kategori_buku = new KategoriBuku;

        $kategori_buku->nama_kategori = $req->post('nama_kategori');

        $kategori_buku->save();
        return redirect('/dashboard/kategori');
    }

    public function update(Request $request, $id_kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);
    
        $kategori_buku = KategoriBuku::find($id_kategori);
    
        if ($kategori_buku) {
            $kategori_buku->nama_kategori = $request->nama_kategori;
            $kategori_buku->save();
    
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false, 'message' => 'Kategori tidak ditemukan.']);
    }    


    public function destroy($id_kategori)
    {
        $kategori_buku = KategoriBuku::find($id_kategori);

        if ($kategori_buku) {
            $kategori_buku->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'User not found.']);
    }
}
