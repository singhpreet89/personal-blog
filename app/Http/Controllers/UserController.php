<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\UserUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function comments()
    {
        return view('user.comments');
    }

    public function deleteComment($id)
    {
        Comment::where('id', $id)->where('user_id', Auth::id())->delete();
        return back();
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function profilePost(UserUpdate $request)
    {
        $user = Auth::user();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();

        return back();
    }
}
