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
        $this->middleware('auth')->except('index','categories','allproducts','categoriesid');
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
        $items = Item::inRandomOrder()->paginate(3);
        return view('home', [
            'categories'=>$data,
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

    public function categories(){
        $cats = Category::all();
        return view('categories', compact('cats'));
    }

    public function categoriesid($id){
        $cat = Category::where('id', '=', $id)->value('category');
        $items = Item::where('category', '=', $cat)->paginate(9);
        return view('categoriesid', compact('items'));
    }

    public function allproducts(){
        $items = Item::paginate(9);
        return view('allproducts', compact('items'));
    }
}
