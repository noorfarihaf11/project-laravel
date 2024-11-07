<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisUser;
use App\Models\MenuUser;
use App\Models\Menu;
use App\Models\Category;
use Illuminate\Support\Facades\Log;

class JenisUserController extends Controller
{
    public function index()
    {   
        $user = auth()->user();
        $jenis_users = JenisUser::all();
        $menu_users = MenuUser::all();
        $categories = Category::all();
        $menus = Menu::all();
        $user_photos = $user->user_photos;
        return view('role.index', compact('menu_users','user','jenis_users','menus','user_photos','categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required'
        ]);

        JenisUser::create($validatedData);

        return redirect('/dashboard/role')->with('success', 'New role has been added!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_jenis_user' => 'required|integer|exists:jenis_users,id_jenis_user',
            'name' => 'required|string|max:255'
        ]);

        // Find user by ID
        $jenis_users = JenisUser::find($request->id_jenis_user);

        if ($jenis_users) {
            // Update user data
            $jenis_users->name = $request->name;
            $jenis_users->save();

            // Return success response
            return response()->json(['success' => true]);
        }

        // Return error response if user not found
        return response()->json(['success' => false, 'message' => 'Update failed.']);
    }

    public function destroy($id_jenis_user)
    {
        $jenis_users = JenisUser::find($id_jenis_user);
    
        if ($jenis_users) {
            $jenis_users->delete();
            return response()->json(['success' => true]);
        }
    
        Log::error('User not found: ' . $id_jenis_user);
        return response()->json(['success' => false, 'message' => 'User not found.']);
    }

}
