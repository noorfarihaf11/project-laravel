<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuUser;
use App\Models\MenuLevel;
use App\Models\Menu;
use App\Models\JenisUser;
use Illuminate\Support\Facades\Log;

class MenuUserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $menu_users = MenuUser::with(['hasRole', 'menus'])->get();
        $menus = Menu::all();
        $menu_levels = MenuLevel::all();
        $jenis_users = JenisUser::all();

        return view('settingmenu.index', compact('user', 'menu_users', 'menus', 'menu_levels', 'jenis_users'));
    }

    public function store(Request $request, $menu_id)
    {
        $validatedData = $request->validate([
            'id_jenis_user' => 'required',
        ]);

        // Create a new relation with menu_id
        MenuUser::create(array_merge($validatedData, ['menu_id' => $menu_id]));

        return response()->json(['success' => true, 'message' => 'New setting menu has been added!']);
    }


    public function destroy($menu_id)
    {
        $menu_user = MenuUser::where('menu_id', $menu_id)
            ->where('id_jenis_user', request()->id_jenis_user) // Assuming you get id_jenis_user from the request
            ->first();

        if ($menu_user) {
            $menu_user->delete();
            return response()->json(['success' => true, 'message' => 'Menu setting deleted successfully!'], 200);
        }

        return response()->json(['success' => false, 'message' => 'Menu not found.'], 404);
    }



}
