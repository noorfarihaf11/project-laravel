<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuUser;
use App\Models\Menu;
use App\Models\MenuLevel;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;



class AdminCategoryController extends Controller
{
   
    use AuthorizesRequests;
    public function index()
    {   
        $user = auth()->user();
        $menu_users = MenuUser::all();
        $categories = Category::all();
        $menus = Menu::all();
        $user_photos = $user->user_photos;
        return view('dashboard.categories.index', compact('categories', 'menu_users','user','menus','user_photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $menus = Menu::all();
        $menu_users = MenuUser::all(); 
        $categories = Category::all();
        $user_photos = $user->user_photos;
        return view('dashboard.categories.create', compact('menus', 'menu_users','user','categories','user_photos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'color' => 'required',
        ]);

        Category::create($validatedData);

        return redirect('/dashboard/categories')->with('success', 'New category has been added!');
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
