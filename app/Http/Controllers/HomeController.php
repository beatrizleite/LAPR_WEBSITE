<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function sellerHome()
    {
        return view('sellerHome');
    }

    public function adminHome()
    {
        return view('adminHome');
    }

    public function userProfile()
    {
        return view('userProfile');
    }
}
