<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\CreatePost;
use App\Http\Requests\UserUpdate;
use App\Post;
use App\User;
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
        $comments = Comment::all();
        return view('admin.comments', compact('comments'));
    }

    public function deleteComment($id)
    {
        $comment = Comment::where('id', $id)->first();
        $comment->delete();
        return back();
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function editUser($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.editUser', compact('user'));
    }

    public function editUserPost(UserUpdate $request, $id)
    {
        $user = User::where('id', $id)->first();
        $user->name = $request['name'];
        $user->email = $request['email'];

        if($request['author'] == 1) {
            $user->author = true;
        } else{
            $user->author = false;
        }
        if($request['admin'] == 1) {
            $user->admin = true;
        } else{
            $user->admin = false;
        }

        $user->save();
        return back()->with('success', 'User updated successfully');
    }

    public function deleteUser($id)
    {
        $user = User::where('id', $id)->first();
        $user->delete();
        return back();
    }
}
