@extends('layouts.app')

@section('content')
    <p></p>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h1>Cart</h1>
                    <div class="col-md-4">
                        <div class="card-body">
                            @foreach ($items as $item)
                                <div class="col-sm-4 img-portfolio">
                                    <h3>
                                        <a href="detail/{{ $item->id }}"><b>{{ $item->name }}</b></a>
                                    </h3>
                                </div>
                                <img width="70%" class="img-fluid img-thumbnail"
                                alt="{{ $item->name }}" src="{{ asset('storage/images/' . $item->image) }}">
                                <form action="/removeFromCart/{{$item->cart_id}}" class="d-flex" method="get">
                                    <button style="margin-top:5px;" class="btn btn-danger">Remove from Cart</button>
                                </form>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
