<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('status');
    }
    
    public function show($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        return view('profile/profile', compact('user'));
    }

    public function edit($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        return view('profile/edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image',
        ], [
            'image.image' => 'El archivo debe ser una imagen.',
        ]);

        $user = User::find($id);

        if($request->name != null){
            $user->name = $request->name;
            $user->slug = str::slug($request->name);
        }

        if($request->description != null){
            $user->description = $request->description;
        }

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $img = $user->image;
            Storage::delete('public/images/profiles/' . $img);

            $image = $request->file('image');
            $dateTime = Carbon::now();
            $name = $dateTime->format('Ymd_His') . '.webp';
            Image::make($image)->encode('webp', 75)->save(storage_path('app/public/images/profiles/' . $name));
            $user->image = $name;
        }

        $user->save();

        return Redirect::route('profile.show', ['slug' => $user->slug]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->status = 0;
        $user->save();

        $img = $user->image;
        Storage::delete('public/images/profiles/' . $img);
        return redirect("/home");
    }

    public function editPassword($slug)
    {
        return view('profile/password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ],[
            'old_password.required' => 'La contraseña antigua es requerida.',
            'password.required' => 'La contraseña es requerida.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $user = Auth::user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return Redirect::route(route('profile.show', ['slug'=>Auth::user()->slug]))->with('success', 'Contraseña cambiada exitosamente.');
        } else {
            return back()->withErrors(['old_password' => 'La contraseña antigua no es válida.'])->withInput();
        }
    }

    public function posts($slug)
    {
        $user = User::with('posts')->where('slug', $slug)->firstOrFail();
        return view('profile/posts', compact('user'));
    }
}
