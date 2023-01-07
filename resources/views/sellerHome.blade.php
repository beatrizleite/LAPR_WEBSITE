@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <form action="{{route('allUsers')}}" method="post">
                        @csrf
                        
                        <input type="hidden" name="item_id" value={{ $item->id }}>
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                    <form action="{{route('allItems')}}" method="post">
                        @csrf
                        
                        <input type="hidden" name="item_id" value={{ $item->id }}>
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                    <form action="{{route('allCategories')}}" method="post">
                        @csrf
                        
                        <input type="hidden" name="item_id" value={{ $item->id }}>
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
