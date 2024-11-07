<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\MenuUser;
use App\Models\Menu;
use App\Models\JenisUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index()
    {
        // Mendapatkan semua data pengguna
        $users = User::all();
        $user_activities = UserActivity::all();
        $menu_users = MenuUser::all();
        $menus = Menu::all();
        $jenis_users = JenisUser::all();

        // dd($users);
        // Mengirim data ke view
        return view('dashboard.masteruser.index', compact('users', 'user_activities', 'menu_users', 'menus', 'jenis_users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'id_jenis_user' => 'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'password' => $validatedData['password'], // Use the hashed password here
            'id_jenis_user' => $validatedData['id_jenis_user'],
        ]);

        return redirect('/dashboard/useroperations')->with('success', 'New user has been added!');
    }
    public function update(Request $request)
    {
        $request->validate([
            'id_user' => 'required|integer|exists:users,id_user',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'username' => 'required|string|max:255',
            'id_jenis_user' => 'required|string|max:255',
        ]);

        // Find user by ID
        $user = User::find($request->id_user);

        if ($user) {
            // Update user data
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->id_jenis_user = $request->id_jenis_user;
            $user->save();

            // Return success response
            return response()->json(['success' => true]);
        }

        // Return error response if user not found
        return response()->json(['success' => false, 'message' => 'User not found.']);
    }


    public function destroy($id_user)
    {
        $user = User::find($id_user);

        if ($user) {
            $user->delete();
            return response()->json(['success' => true]);
        }

        Log::error('User not found: ' . $id_user);
        return response()->json(['success' => false, 'message' => 'User not found.']);
    }
}
