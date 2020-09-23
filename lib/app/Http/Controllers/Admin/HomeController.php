<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function getHome()
    {
        return view('backend.index');
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->intended('login');
    }
}
