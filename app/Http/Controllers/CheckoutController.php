<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{

    public function index()
    {
        $cartitems = Cart::where('user_id', '=', Auth::id())->get();
        return view('checkout', compact('cartitems'));
    }

    public function placeOrder(Request $request)
    {
        $order = new Order();
        $order->firstname = $request->input('firstname');
        $order->lastname = $request->input('lastname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address = $request->input('address');
        $order->city = $request->input('city');
        $order->country = $request->input('country');
        $order->postcode = $request->input('postcode');

        $order->save();

        $cartitems = Cart::where('user_id', '=', Auth::id())->get();
        foreach ($cartitems as $item){
            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $item->item_id,
                'price' => $item->items->price
            ]);
        }

    }
}