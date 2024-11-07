<?php

namespace App\Http\Controllers;

use App\Models\UserPhoto;
use App\Models\User;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserActivityController;
use App\Models\UserActivity;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $menus = Menu::all();
        $user_photos = $user->user_photos;
        return view('dashboard.profile.index', compact('user','menus','user_photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
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
    public function edit(User $user)
    {
        $user = auth()->user();
        $menus = $user->menus()->with('level')->get();
        $user_photos = $user->user_photos;
        return view('dashboard.profile.edit', compact('user','menus','user_photos',));
    }


    public function update(Request $request, User $user)
    {
        $user = Auth::user();
        $user->name = $request->post('name');
        $user->username = $request->post('username');
        $user->email = $request->post('email');

        $user->save();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Simpan file gambar ke dalam penyimpanan yang diinginkan (misalnya, penyimpanan public)
            $path = $image->store('user-images');

            // Simpan image ke database
            $user_photo = new UserPhoto();
            $user_photo->id_user = auth()->user()->id_user; // Sesuaikan dengan metode autentikasi yang Anda gunakan
            $user_photo->image = $path;
            $user_photo->save();

            $this->logUserActivity('Updated profile', 'success');

        return redirect('/dashboard/profile')->with('success', 'Profile has been updated!');
    }
}
    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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
