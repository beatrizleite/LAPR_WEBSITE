<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    public function detail($id)
    {
        $data = Item::find($id);
        return view('detail', ['item' => $data]);
    }

    public function search(Request $request)
    {
        $data = Item::where('name', 'ilike', '%' . $request->input('query') . '%')->get();
        return view('search', ['items' => $data]);
    }

    public function addToCart(Request $request)
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
    public static function cartItem()
    {
        $userid = Auth::user()->id;
        return Cart::where('user_id', $userid)->count();
    }

    public function cart()
    {
        if (Auth::check()) {
            $userid = Auth::user()->id;
            $items = DB::table('cart')
                ->join('items', 'cart.item_id', '=', 'items.id')
                ->where('cart.user_id', $userid)
                ->select('items.*', 'cart.id as cart_id')
                ->get();
            return view('cart', ['items' => $items]);
        } else {
            return redirect('login')->with('error', "You're not logged in!");
        }
    }

    public function removeFromCart($id)
    {
        Cart::destroy($id);
        return redirect('');
    }
}
