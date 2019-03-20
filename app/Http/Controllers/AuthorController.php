<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function __construct()
    {
        // The name of the middleware here should be same as what is registered under the kernel.php
        // And we are explicitly passing the value author into the middleware
        $this->middleware('checkRole:author');
    }

    public function dashboard()
    {
        return view('author.dashboard');
    }

    public function posts()
    {
        return view('author.posts');
    }

    public function comments()
    {
        return view('author.comments');
    }
}
