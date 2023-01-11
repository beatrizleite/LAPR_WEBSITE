@include('layouts.app')

@section('content')

<?php 
    use App\Models\Cart;
    $total = 0;
    $cartitems = Cart::where('user_id', '=', Auth::id())->get();
    foreach ($cartitems as $item){
        $total += $item->items->price;
    }
?>

<form action="{{ route('pay') }}" method="POST">
    @csrf
    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="{{ env('STRIPE_KEY') }}"
    data-name="Payment of {{ $total }}€" data-amount="{{ $total * 100 }}"
    data-currency="EUR"
    data-description="Insert your card information"></script>
</form>