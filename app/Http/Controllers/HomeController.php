<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('postIndex', compact('posts'));
    }
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $comments = $post->comments()->with('user')->get();
        return view('postsShow', compact('post', 'comments'));
    }

    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('postEdit', compact('post'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $image = $request->file('image');
        $dateTime = Carbon::now();
        $name = $dateTime->format('Ymd_His') . '.webp';
        Image::make($image)->encode('webp', 75)->save(storage_path('app/public/images/posts/' . $name));
        $post = new Post();
        $post->title = $request->title;
        $user_id = Auth::id();
        $slug = Str::slug($request->title);
        $uniqueSlug = $user_id . '-' . $slug . '-' . uniqid();
        $post->slug = $uniqueSlug;
        $post->image = $name;
        $post->body = $request->body;
        $post->user_id = $user_id;
        $post->status = 1;
        $post->save();
        return redirect()->route('post.index');
    }

    public function update(Request $request, $id)
    {

        $post = Post::find($id);
        $post->title = $request->title;
        $post->slug = str::slug($request->title);
        $post->body = $request->body;
        $post->save();
        return redirect()->route('post.show', ['slug' => $post->slug]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        $img = $post->image;
        Storage::delete('public/images/posts/' . $img);
        return redirect('/home');
    }

    public function commentStore(Request $request, $id)
    {
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $id;
        $comment->content = $request->comment;
        $comment->save();
        return redirect()->back();
    }

    public function commentsDestroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->back();
    }
}
