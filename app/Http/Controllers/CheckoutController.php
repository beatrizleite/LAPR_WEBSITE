<?php

namespace App\Http\Controllers;

use Stripe;
use Dompdf\Dompdf;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderConfirmed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

    public function sendMail()
    {
        $data["name"] = User::where('id', '=', Auth::id())->value('name');
        $data["email"] = User::where('id', '=', Auth::id())->value('email');
        $data["subject"] = 'Order Confirmed';
        $data["body"] = '<body>Order Confirmed</body>';

        $dompdf = new Dompdf();
        $html = "<p><h1>thank you ".$data["name"]."!</h1></p>
        <p>Your order was received!</p>";
        $dompdf->loadHtml($html);
        $dompdf->render();

        $pdf = $dompdf->output();
        $data["pdf"] = "OrderConfirmed.pdf";
        file_put_contents('OrderConfirmed.pdf', $pdf);
        Mail::to($data["email"])->send(new OrderConfirmed($data["name"], $data["pdf"]));

        return redirect('')->with("Email sent");
    }

}
