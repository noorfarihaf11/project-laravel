<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\MenuUser;
use App\Models\Menu;

class UserActivityController extends Controller
{
    public function index()
    {
            $user = auth()->user();
            $user_activities = UserActivity::with('users')->get();
            $menu_users = MenuUser::all();
            $menus = Menu::all();
            $user_photos = $user->user_photos;
     
            return view('dashboard.users.index',compact('user', 'user_activities', 'menu_users', 'menus','user_photos'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        UserActivity::create([
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
            'id_user' => Auth::id(),
            'delete_mark' => 'N', // 
            'create_by' => auth()->user()->name
        ]);
        return redirect('/home');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
