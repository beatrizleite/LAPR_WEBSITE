<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::check()) {
            $userid = Auth::user()->id;
            $usertype = User::where('id', '=', $userid)->value('type');
        } else {
            $usertype = -1;
        }
        $data = Category::inRandomOrder()->get();
        $items = Item::inRandomOrder()->get();
        for ($i=0; $i < count($data); $i++) {
            $images[] = Item::where('category', '=', $data[0])
            ->get();
        }
        return view('home', [
            'categories'=>$data,
            'images'=>$images,
            'items'=>$items,
            'user_type'=>$usertype
        ]);
    }

    public function sellerHome()
    {
        return view('seller.sellerHome');
    }

    public function adminHome()
    {
        return view('admin.adminHome');
    }

    public function userProfile()
    {
        return view('userProfile');
    }
}
