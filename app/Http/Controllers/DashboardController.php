<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Models\MenuUser;
use App\Models\Menu;
use App\Models\Dashboard;
use App\Models\User;
use Illuminate\Support\Facades\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $menus = Menu::all();
        $user_photos = $user->user_photos;
        return view('dashboard.index', compact('user', 'menus', 'user_photos'));
    }
    

    
}

