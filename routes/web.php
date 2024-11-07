<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuLevel;
use App\Models\MenuUser;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminMenuController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\InfoGempaController;
use App\Http\Controllers\InfoCuacaController;
use App\Http\Controllers\UserActivityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JenisUserController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\MenuUserController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\EmitenController;
use App\Http\Controllers\TransaksiHarianController;

Route::get('/coba', function () {
    return view('/auth.login2');
});

// Route::get('/dashboard', function () {
//     return view('/dashboard.index');
// });

Route::get('/home', function () {
    return view('home', ['title' => 'Home Page']);
});

Route::get('/posts', function () {
    return view('posts', ['title' => 'Blog','posts' => Post::all()]);
});

Route::get('/posts/{post:slug}', function(Post $post){
   return view('post', ['title'=> 'Single Post', 'post' => $post]);
   
});

Route::get('/authors/{user:username}', function(User $user){
   return view('posts', ['title'=> count($user->posts)  . ' Articles By ' . $user->name,
   'posts' => $user->posts]);
   
});

Route::get('/categories/{category:name}', function(Category $category){
   return view('posts', ['title'=> ' Articles in :  ' . $category->name,
   'posts' => $category->posts]);
   
});

Route::get('/about', function () {
    return view('about', ['nama' => 'Noor Fariha']);
});

Route::get('/contact', function ()  {
    return view('contact',['nama' => 'Noor Fariha']);
});


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/login',[LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register',[RegisterController::class,'store']);

Route::get('/dashboard/post/checkSlug', [DashboardPostController::class,'checkSlug' ]);
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')
->middleware('auth');

// Route::resource('/dashboard/menus', AdminMenuController::class)->middleware('auth');

Route::resource('/dashboard/users', UserActivityController::class)->middleware('auth');

Route::resource('/dashboard/profile', ProfileController::class)->middleware('auth');

Route::get('/dashboard/useroperations', [UserController::class, 'index'])->middleware('admin');
Route::post('/dashboard/useroperations', [UserController::class, 'store'])->middleware('admin');
Route::put('/dashboard/useroperations/{id_user}', [UserController::class, 'update'])->middleware('admin');
Route::delete('/dashboard/useroperations/{id_user}', [UserController::class, 'destroy'])->middleware('admin');

Route::get('/dashboard/role', [JenisUserController::class, 'index'])->middleware('admin');
Route::post('/dashboard/role', [JenisUserController::class, 'store'])->middleware('admin');
Route::put('/dashboard/role/{id_jenis_user}', [JenisUserController::class, 'update'])->middleware('admin');
Route::delete('/dashboard/role/{id_jenis_user}', [JenisUserController::class, 'destroy'])->middleware('admin');

Route::get('/dashboard/menu', [AdminMenuController::class, 'index'])->middleware('admin');
Route::post('/dashboard/menu', [AdminMenuController::class, 'store'])->middleware('admin');
Route::put('/dashboard/menu/{menu_id}', [AdminMenuController::class, 'update'])->middleware('admin');
Route::delete('/dashboard/menu/{menu_id}', [AdminMenuController::class, 'destroy'])->middleware('admin');

Route::get('/dashboard/settingmenu', [MenuUserController::class, 'index'])->middleware('admin');
Route::post('/dashboard/settingmenu/{menu_id}', [MenuUserController::class, 'store'])->middleware('admin'); // Adjusted to use menu_id
Route::delete('/dashboard/settingmenu/{menu_id}', [MenuUserController::class, 'destroy'])->middleware('admin'); // Adjusted to use menu_id

Route::post('/posts/{post:slug}/comments', [CommentController::class, 'store'])->middleware('auth');
Route::put('/posts/{post:slug}/comments/{id_komen}', [CommentController::class, 'update'])->middleware('auth');

Route::post('/posts/{post:slug}/like', [LikeController::class, 'like'])->middleware('auth');
Route::delete('/posts/{post:slug}/like', [LikeController::class, 'unlike'])->middleware('auth');

Route::get('/dashboard/infogempa', [InfoGempaController::class, 'index'])->middleware('auth');
Route::get('/dashboard/infocuaca', [InfoCuacaController::class, 'index'])->middleware('auth');

Route::get('/dashboard/buku', [BukuController::class, 'index']);
Route::post('/dashboard/buku', [BukuController::class, 'add_buku']);

Route::get('/dashboard/kategori', [KategoriBukuController::class, 'index']);
Route::post('/dashboard/kategori', [KategoriBukuController::class, 'add_kategori']);
Route::put('/dashboard/kategori/{id_kategori}', [KategoriBukuController::class, 'update']);
Route::delete('/dashboard/kategori/{id_kategori}', [KategoriBukuController::class, 'destroy']);

Route::get('/dashboard/emiten', [EmitenController::class, 'index']);
Route::post('/dashboard/emiten', [EmitenController::class, 'store']);

Route::get('/dashboard/saham', [TransaksiHarianController::class, 'index']);
Route::post('/dashboard/saham', [TransaksiHarianController::class, 'store']);




