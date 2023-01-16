<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('index', [
            'title' => "Login"
        ]);
    }

    public function loginAction(Request $request)
    {
        // $validated = $request->validate([
        //     'email' => 'required|min:4|max:20',
        //     'password' => 'required|min:4',
        // ]);

        // dd($validated);

        $email      = $request['email'];
        $password   = $request['password'];

        $login = User::where('email', $email)
                    ->where('password', $password)->first();

        if (!empty($login)) {
            $user_id = $login->user_id;
            Auth::loginUsingId($user_id);

            return redirect()->route('homepage')->with('valid', 'Berhasil Login');
        } else {
            return redirect()->route('login')->with('invalid', 'Gagal Login');
        }
    }

    public function home (){
        return view('content/index', [
            'title' => "Home"
        ]);
    }

    public function logoutAction (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}
