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

    public $data;

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
        $name = User::where('id', '=', Auth::id())->value('name');


        $data["userid"] = Auth::id();
        $data["firstname"] = $request->input('firstname');
        $data["lastname"] = $request->input('lastname');
        $data["email"] = $email;
        $data["phone"] = $request->input('phone');
        $data["address"] = $request->input('address');
        $data["city"] = $request->input('city');
        $data["country"] = $request->input('country');
        $data["postcode"] = $request->input('postcode');
        
        $total = 0;
        $cartitems = Cart::where('user_id', '=', Auth::id())->get();
        foreach ($cartitems as $item){
            $total += $item->items->price;
        }

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
        $customer = Stripe\Customer::create(array(
            'address' => [
                'line1' => $data["address"],
                'postal_code' => $data["postcode"],
                'city' => $data["city"],
                'country' => $data["country"],
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
                'name' => $data["firstname"] . ' ' . $data["lastname"],
                'address' => [
                    'line1' => $data["address"],
                    'postal_code' => $data["postcode"],
                    'city' => $data["city"],
                    'country' => $data["country"],
                ],
            ],

        ]);


        $order = new Order();

        $order->userid = $data["userid"];
        $order->firstname = $data["firstname"];
        $order->lastname = $data["lastname"];
        $order->email = $email;
        $order->phone = $data["phone"];
        $order->address = $data["address"];
        $order->city = $data["city"];
        $order->country = $data["country"];
        $order->postcode = $data["postcode"];

        $order->save();

        foreach ($cartitems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $item->item_id,
                'price' => $item->items->price
            ]);
            Cart::destroy($item->id);
        }

        return redirect('sendMail')->with("Payment success");
    }

    public function sendMail(){
        redirect('');
    }

}
