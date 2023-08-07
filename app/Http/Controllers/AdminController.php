<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    // public function index()
    // {
    //     return view('admin/adminIndex');
    // }

    public function users()
    {
        $users = User::with('role')->get();
        return view('admin/adminIndex', compact('users'));
    }

    // public function update(Request $request, $id)
    // {
    //     $user = User::find($id);
    //     $user->role_id = $request->role;
    //     $user->save();
    //     return redirect()->route('admin.users');
    // }

    public function show($user_id)
    {
        $user = User::findOrFail($user_id);
        $posts = $user->posts;

        return view('admin/admin.show', compact('user', 'posts'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.index');
    }
}