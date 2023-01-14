@include('layouts.app')

@section('content')

<form action="{{ route('pay') }}" method="POST">
    @csrf
    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
    data-key="{{ env('STRIPE_KEY') }}"
    data-name="Payment of {{ $total }}€" data-amount="{{ $total * 100 }}"
    data-currency="EUR"
    data-description="Insert your card information"></script>
</form>