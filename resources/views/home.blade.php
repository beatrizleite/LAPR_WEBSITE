@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container">
                <div class="row">
                @foreach ($items as $item)
                    <div class="col-sm-4 img-portfolio">
                        <h5>{{$item->category}}</h5>
                        {{--{{ route('product', ['id'=>$item->id])}}--}}
                        <h3>
                            <a href="#!"><b>{{$item->name}}</b></a>
                        </h3>
                            <img alt="{{$item->name}}" src="{{asset('storage/images/'.$item->image)}}">
                            
                        <hr>
                    </div>
                @endforeach
                    
                </div>
              </div>
        </div>
    </div>
</div>
@endsection
