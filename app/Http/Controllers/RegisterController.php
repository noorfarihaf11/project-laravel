<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Menu;
use App\Models\UserActivity;


class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
    $validatedData = $request->validate([
        'email' => 'required|max:200|email:dns',
        'username' => ['required','min:5','max:60'],
        'password' => 'required|min:5'
    ]);

    $validatedData['password']=Hash::make($validatedData['password']);

    $user = User::create($validatedData);
    $id_user = $user->id_user;
    $user = $this->createMenu($id_user);

    $this->logUserActivity('Registered', 'success', $id_user);

    return redirect ('/login')->with('success', 'Registration Successful! Please Login');


    }
    public function createMenu($id_user)
    {
        $menus = Menu::find([1, 2, 3, 8]); // Mengambil menu dengan ID 1, 2, dan 3

        $user = User::find($id_user);

        if ($user) {
            foreach ($menus as $menu) {
                $user->menus()->attach($menu->menu_id);
            }
        }
    }

    public function logUserActivity($description, $status, $id_user)
    {
        UserActivity::create([
            'description' => $description,
            'status' => $status,
            'id_user' => $id_user,
            'delete_mark' => 'N',
        ]);
    
        return redirect('/login');
    }
}    
