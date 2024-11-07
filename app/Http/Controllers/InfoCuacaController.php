<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuUser;
use App\Models\MenuLevel;
use App\Models\Menu;
use App\Models\JenisUser;
use Illuminate\Support\Facades\Log;

class InfoCuacaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $menu_users = MenuUser::with(['hasRole', 'menus'])->get();
        $menus = Menu::all();
        $menu_levels = MenuLevel::all();
        $jenis_users = JenisUser::all();

        return view('infocuaca.index', compact('user', 'menu_users', 'menus', 'menu_levels', 'jenis_users'));
    }
}