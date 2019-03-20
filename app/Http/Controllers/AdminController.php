<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePost;
use App\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // The name of the middleware here should be same as what is registered under the kernel.php
        // And we are explicitly passing the value admin into the middleware
        $this->middleware('checkRole:admin');
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function posts()
    {
        $posts = Post::all();
        return view('admin.posts', compact('posts'));
    }

    public function postEdit($id)
    {
        $post = Post::where('id', $id)->first();
        return view('admin.editPost', compact('post'));
    }

    public function postEditPost(CreatePost $request, $id)
    {
        $post = Post::where('id', $id)->first();
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->save();

        return back()->with('success', 'Post updated successfully');
    }

    public function deletePost($id)
    {
        $post = Post::where('id', $id)->first();
        $post->delete();

        return back();
    }

    public function comments()
    {
        return view('admin.comments');
    }

    public function users()
    {
        return view('admin.users');
    }
}
