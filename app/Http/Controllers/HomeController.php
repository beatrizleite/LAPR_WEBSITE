<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $data = Item::inRandomOrder()->limit(6)->get();
        return view('home', ['items'=>$data]);
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
