<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class ProfileController extends Controller
{
    public function show($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        $posts = $user->posts;
        return view('profile/profile', compact('user', 'posts'));
    }

    public function edit($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        return view('profile/edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $image = $request->file('image');
        $dateTime = Carbon::now();
        $name = $dateTime->format('Ymd_His') . '.webp';
        Image::make($image)->encode('webp', 75)->save(storage_path('app/public/images/profiles/' . $name));

        $user = User::find($id);
        $user->name = $request->name;
        $user->slug = str::slug($request->name);
        $user->description = $request->description;

        $img = $user->image;
        Storage::delete('public/images/profiles/' . $img);
        $user->image = $name;

        $user->save();

        return Redirect::route('profile.show', ['slug' => $user->slug]);
    }

    public function editPassword($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        return view('profile/password', compact('user'));
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'old_password' => ['required', 'password'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $user = User::find($id);
        $user->password = bcrypt($request->new_password);
        $user->save();
        return Redirect::route('profile.show', ['slug' => $user->slug]);
    }

    public function posts($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();
        $posts = $user->posts;
        return view('profile/posts', compact('user', 'posts'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        $img = $user->image;
        Storage::delete('public/images/profiles/' . $img);
        return redirect("/home");
    }
}
