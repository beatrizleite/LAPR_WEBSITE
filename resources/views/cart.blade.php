@extends('layouts.app')

@section('content')
    <p></p>
    <div class="container md-5">
            <div class="card">
                <h1>Cart</h1>
                    <div class="card-body">
                        <?php $total = 0 ?>
                        @foreach ($items as $item)
                            <div class="col-sm-4 img-portfolio">
                                <h3>
                                    <a href="detail/{{ $item->id }}"><b>{{ $item->name }}</b></a>
                                </h3>
                            </div>
                            <img class="img-fluid img-thumbnail" alt="{{ $item->name }}"
                            src="{{ asset('storage/images/' . $item->image) }}"
                            style="object-fit:fill; width:175px; height:120px; border: solid 1px #CCC">
                            <form action="/removeFromCart/{{$item->cart_id}}" class="d-flex" method="get">
                                <button style="margin-top:5px;" class="btn btn-danger">Remove from Cart</button>
                                </form>
                                <?php $total = $total + $item->price ?>
                                <hr>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <h5>Total price: {{$total}}€</h5>
                            <a href="{{route('checkout')}}" class="btn btn-outline-success">
                                Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
