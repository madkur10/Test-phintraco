<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::select('user_id', 'name', 'email', 'password', 'role')->whereNull('deleted_by')
                                                                            ->get();
        return view('content/users', [
            'title' => "Users",
            'list_user' => $users,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|min:4',
            'password' => 'required|min:4',
            'role' => 'required',
        ]);

        $name = $validated['name'];
        $email = $validated['email'];
        $password = $validated['password'];
        $role = $validated['role'];
        
        $user_id = Auth::user()->user_id;

        $insert_user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role,
            'created_by' => $user_id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('users');
    }

    public function update(Request $request)
    {
         $validated = $request->validate([
            'user_id' => 'required',
            'name' => 'required|min:4',
            'email' => 'required|min:4',
            'password' => 'required|min:4',
            'role' => 'required',
        ]);

        $user_id = $validated['user_id'];
        $name = $validated['name'];
        $email = $validated['email'];
        $password = $validated['password'];
        $role = $validated['role'];
        
        $session_user_id = Auth::user()->user_id;

        $update_user = User::where('user_id', $user_id)->update([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role,
            'updated_by' => $session_user_id,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('users');
    }

    public function destroy(Request $request) 
    {
        $user_id = $request['user_id'];
        $session_user_id = Auth::user()->user_id;
        $destroy_user = User::where('user_id', $user_id)->update([
            'deleted_by' => $session_user_id,
            'deleted_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('users');
    }
}
