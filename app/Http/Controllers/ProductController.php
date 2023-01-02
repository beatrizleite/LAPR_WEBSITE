<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    
    function detail($id)
    {
        $data = Item::find($id);
        return view('detail', ['item' => $data]);
    }

    function search(Request $request)
    {
        $data = Item::where('name', 'ilike', '%' . $request->input('query') . '%')->get();
        return view('search', ['items' => $data]);
    }
    function addToCart(Request $request)
    {
        if (Auth::check()) {
            $cart = new Cart;
            $cart->user_id = Auth::user()->id;
            $cart->item_id = $request->item_id;
            $cart->save();
            return redirect('/');

        } else {
            return redirect('login')->with('error', "You're not logged in!");
        }
    }
}