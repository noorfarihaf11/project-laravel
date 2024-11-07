<?php

namespace App\Http\Controllers;

use App\Models\MenuUser;
use App\Models\MenuLevel;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\UserActivityController;
use App\Models\JenisUser;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Auth;

class AdminMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $menu_users = MenuUser::with(['hasRole', 'menus'])->get(); 
        $menus = Menu::all();
        $menu_levels = MenuLevel::all();
        $user_photos = $user->user_photos;
        $jenis_users = JenisUser::all();
        return view('dashboard.menus.index', compact('user','menu_users', 'menus','user_photos','menu_levels','jenis_users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $menus = Menu::all();
        $menu_users = MenuUser::all(); // Fetch menu users
        $menu_levels = MenuLevel::all();
        $user_photos = $user->user_photos;
        return view('dashboard.menus.create', compact('menus', 'menu_users','user','menu_levels','user_photos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_level' => 'required',
            'create_by' => 'required',
            'menu_name' => 'required|max:20',
            'menu_link' => 'required',
            'menu_icon' => 'required'
        ]);

        Menu::create($validatedData);

        $this->logUserActivity('Created new menu', 'success');

        return redirect('/dashboard/menu')->with('success', 'New menu has been added!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_level' => 'required',
            'create_by' => 'required',
            'menu_name' => 'required|max:20',
            'menu_link' => 'required',
            'menu_icon' => 'required'
        ]);

        $menu = Menu::find($request->menu_id);

        if ($menu) {
            $menu->id_level = $request->id_level;
            $menu->create_by = $request->create_by;
            $menu->menu_name = $request->menu_name;
            $menu->menu_link = $request->menu_link;
            $menu->menu_icon = $request->menu_icon;
            $menu->save();

            // Return success response
            return response()->json(['success' => true]);
        }

        // Return error response if user not found
        return response()->json(['success' => false, 'message' => 'Menu not found.']);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($menu_id)
    {
        $menu = Menu::find($menu_id);

        if ($menu) {
            $menu->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Menu not found.']);
    }

    public function logUserActivity($description, $status)
    {
        UserActivity::create([
            'description' => $description,
            'status' => $status,
            'id_user' => Auth::id(),
            'delete_mark' => 'N',
        ]);
    
        return redirect('/home');
    }
}
