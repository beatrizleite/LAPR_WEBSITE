@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 75px;">
        <div class="row">
            <a href="{{url()->previous()}}">&lt; Go back</a>

            <div class="col-sm-6">
                <img width="70%" class="img-fluid img-thumbnail" src="{{ asset('storage/images/' . $item->image) }}"
                    alt="{{ $item->name }}">
            </div>
            <div class="col-sm-6">
                
                <h4>Category: {{ $item->category }}</h4>
                <hr>
                <h1>{{ $item->name }}</h1>
                <h3>Price: {{ $item->price }}€</h3>
                <hr>
                <h4>Description: {{ $item->description }}</h4>
                <form action="{{route('addToCart')}}" method="post">
                    @csrf
                    <input type="hidden" name="item_id" value={{ $item->id }}>
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
@endsection
