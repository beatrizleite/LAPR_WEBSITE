<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Stripe;

class CheckoutController extends Controller
{
    public $orderid;
    protected $rules = [
        'firstname' => 'required',
        'lastname' => 'required',
        'phone' => 'required|numeric|digits:10',
        'address' => 'required',
        'city' => 'required',
        'country' => 'required',
    ];

    public function index()
    {
        $cartitems = Cart::where('user_id', '=', Auth::id())->get();
        return view('checkout', compact('cartitems'));
    }

    public function placeOrder(Request $request)
    {

        $email = User::where('id', '=', Auth::id())->value('email');

        $order = new Order();

        $order->userid = Auth::id();
        $order->firstname = $request->input('firstname');
        $order->lastname = $request->input('lastname');
        $order->email = $email;
        $order->phone = $request->input('phone');
        $order->address = $request->input('address');
        $order->city = $request->input('city');
        $order->country = $request->input('country');
        $order->postcode = $request->input('postcode');

        $order->save();

        $total = 0;
        $cartitems = Cart::where('user_id', '=', Auth::id())->get();
        foreach ($cartitems as $item){
            $total += $item->items->price;
        }

        return view('payment', compact('total'));
    }

    public function pay(Request $request)
    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
        $total = 0;
        $email = User::where('id', '=', Auth::id())->value('email');
        $name = User::where('id', '=', Auth::id())->value('name');

        $cartitems = Cart::where('user_id', '=', Auth::id())->get();
        foreach ($cartitems as $item) {
            $total += $item->items->price;
        }

        $order = Order::where('userid', '=', Auth::id())->latest()->first();

        $customer = Stripe\Customer::create(array(
            'address' => [
                'line1' => $order->address,
                'postal_code' => $order->postcode,
                'city' => $order->city,
                'country' => $order->country,
            ],
            "email" => $email,
            "name" => $name,
            "source" => $request->stripeToken

        ));

        Stripe\Charge::create([

            "amount" => $total*100,
            "currency" => 'EUR',
            "customer" => $customer->id,
            "description" => "payment to E-commerce",
            'shipping' => [
                'name' => $order->firstname . ' ' . $order->lastname,
                'address' => [
                    'line1' => $order->address,
                    'postal_code' => $order->postcode,
                    'city' => $order->city,
                    'country' => $order->country,
                ],
            ],

        ]);
        foreach ($cartitems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $item->item_id,
                'price' => $item->items->price
            ]);
            Cart::destroy($item->id);
        }
        return redirect('')->with("Payment success");

    }
}
