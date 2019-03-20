<?php

namespace App\Http\Controllers;

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
}
