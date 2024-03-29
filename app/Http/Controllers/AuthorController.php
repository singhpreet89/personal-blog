<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CreatePost;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public function __construct()
    {
        // The name of the middleware here should be same as what is registered under the kernel.php
        // And we are explicitly passing the value author into the middleware
        $this->middleware('checkRole:author');

        $this->middleware('auth');
    }

    public function dashboard()
    {
        $posts = Post::where('user_id', Auth::id())->pluck('id')->toArray();
        $allComments = Comment::whereIn('post_id', $posts)->get();
        $todayComments = $allComments->where('created_at', '>=', \Carbon\Carbon::today())->count();

        return view('author.dashboard', compact('allComments', 'todayComments'));
    }

    public function posts()
    {
        return view('author.posts');
    }

    public function comments()
    {
        $posts = Post::where('user_id', Auth::id())->pluck('id')->toArray();
        $comments = Comment::whereIn('post_id', $posts)->get();

        return view('author.comments', compact('comments'));
    }

    public function newPost()
    {
       return view('author.newPost');
    }

    public function createPost(CreatePost $request)
    {
        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->save();

        return back()->with('success', 'Post is successfully created.');
    }

    public function postEdit($id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        return view('author.editPost', compact('post'));
    }

    public function postEditPost(CreatePost $request, $id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        $post->title = $request['title'];
        $post->content = $request['content'];
        $post->save();

        return back()->with('success', 'Post updated successfully');
    }

    public function deletePost($id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id())->first();
        $post->delete();

        return back();
    }
}
