@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 75px;">
        <div class="row">
            <a href="/">&lt; Go back</a>

            <div class="col-sm-6">
                <img width="70%" class="img-fluid img-thumbnail" src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item->name }}">
            </div>
            <div class="col-sm-6">
                <form action="{{route('cart')}}" method="post">
                    
                    <h4>Category: {{ $item->category }}</h4>
                    <hr>
                    <h1>{{ $item->name }}</h1>
                    <h3>Price: {{ $item->price }}€</h3>
                    <hr>
                    <h4>Description: {{ $item->description }}</h4>
                    <input type="number" value="1" name="quantity" min="1" max="99">
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
@endsection
