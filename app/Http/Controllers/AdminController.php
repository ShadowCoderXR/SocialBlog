<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('admin');
    }

    public function users()
    {
        $users = User::with('role')->get();
        return view('admin/users', compact('users'));
    }

    public function disableUser($id)
    {
        $user = User::find($id);
        if($user->status == 0){
            $user->status = 1;
        }else{
            $user->status = 0;
        }
        $user->save();

        return redirect()->route('admin.users');
    }

    public function destroyUser($id)
    {
        $user = User::find($id);
        $user->delete();

        $img = $user->image;
        Storage::delete('public/images/profiles/' . $img);

        return redirect()->route('admin.users');
    }

    public function posts()
    {
        $posts = Post::with('comments')->orderBy('created_at', 'desc')->get();
        return view('admin/posts', compact('posts'));
    }

    public function disablePosts($id)
    {
        $post = Post::find($id);
        if($post->status == 0){
            $post->status = 1;
        }else{
            $post->status = 0;
        }
        $post->save();

        return redirect()->route('admin.posts', $post->user->id);
    }

    public function destroyPosts($id)
    {
        $post = Post::find($id);
        $post->delete();

        $img = $post->image;
        Storage::delete('public/images/posts/' . $img);

        return redirect()->route('admin.posts', $post->user->id);
    }

    public function comments($id)
    {
        $comments = Comment::where('post_id', $id)->orderBy('created_at', 'desc')->get();
        return view('admin/comments', compact('comments'));
    }

    public function disableComments($id)
    {
        $comment = Comment::find($id);
        if($comment->status == 0){
            $comment->status = 1;
        }else{
            $comment->status = 0;
        }
        $comment->save();

        return redirect()->route('admin.comments', $comment->post->id);
    }

    public function destroyComments($id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return redirect()->route('admin.comments', $comment->user->id);
    }
}