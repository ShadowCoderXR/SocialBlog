<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Post;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('status');
    }

    public function uniqueSlug($title){
        $slug = Str::slug($title);
        $baseSlug = $slug;
        $counter = 1;

        while (Post::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        return $slug;
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')
            ->with('user')
            ->where('status', 1)
            ->paginate(10);
        return view('posts/postIndex', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'nullable|image',
        ], [
            'title.required' => 'El campo título es obligatorio.',
            'body.required' => 'El campo cuerpo es obligatorio.',
            'image.image' => 'El archivo debe ser una imagen.',
        ]);

        $post = new Post([
            'title' => $request->title,
            'slug' => $this->uniqueSlug($request->title),
            'body' => $request->body,
            'user_id' => Auth::id(),
            'status' => 1,
        ]);


        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $image = $request->file('image');
            $dateTime = Carbon::now();
            $name = $dateTime->format('Ymd_His') . '.webp';
            Image::make($image)->encode('webp', 75)->save(storage_path('app/public/images/posts/' . $name));
            
            $post->image = $name;
        }

        $post->save();

        return redirect()->route('post.index');
    }

    public function show($slug)
    {
        $post = Post::with('comments.user')->where('slug', $slug)->firstOrFail();
        return view('posts/postsShow', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image',
        ], [
            'image.image' => 'El archivo debe ser una imagen.',
        ]);

        $post = Post::find($id);

        if($request->title != null){
            $post->title = $request->title;
            $post->slug = $this->uniqueSlug($request->title);
        }

        if($request->body != null){
            $post->body = $request->body;
        }

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $img = $post->image;
            Storage::delete('public/images/posts/' . $img);
            
            $image = $request->file('image');
            $dateTime = Carbon::now();
            $name = $dateTime->format('Ymd_His') . '.webp';
            Image::make($image)->encode('webp', 75)->save(storage_path('app/public/images/posts/' . $name));
            $post->image = $name;
        }

        $post->save();

        return redirect()->route('post.show', ['slug' => $post->slug]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->status = 0;
        $post->save();
        return redirect('/home');
    }

    public function commentStore(Request $request, $id)
    {
        $request->validate([
            'content' => 'required',
        ], [
            'content.required' => 'El campo contenido es obligatorio.',
        ]);

        $comment = new Comment([
            'user_id' => Auth::user()->id,
            'post_id' => $id,
            'content' => $request->content,
        ]);
        $comment->save();

        return redirect()->back();
    }

    public function commentUpdate(Request $request, $id)
    {
        $request->validate([
            'content' => 'required',
        ], [
            'content.required' => 'El campo contenido es obligatorio.',
        ]);

        $comment = Comment::find($id);
        $comment->content = $request->content;
        $comment->save();

        return redirect()->back();
    }

    public function commentsDestroy($id)
    {
        $comment = Comment::find($id);
        $comment->status = 0;
        $comment->save();
        return redirect()->back();
    }
}
