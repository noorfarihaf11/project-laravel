<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserActivityController;
use App\Models\UserActivity;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $this->logUserActivity('Logged in', 'success');

            return redirect()->intended('/home');
        }
        return back()->with('loginError', 'Login Failed!');
    }

    public function logout(Request $request): RedirectResponse
    {

        $this->logUserActivity('Logged out', 'success');
    Auth::logout();
 
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();

    return redirect('/home');

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