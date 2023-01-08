@include('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container">
                <div class="row">
                    @if($items->count() == 0)
                        <h1>No items in this category</h1>
                    @else
                    @foreach ($items as $item)
                        <div class="col-sm-4 img-portfolio">
                            <h3>
                                <a href="{{route('detail',$item->id)}}"><b>{{$item->name}}</b></a>
                            </h3>
                            <img alt="{{$item->name}}" src="{{asset('storage/images/'.$item->image)}}"
                            style="object-fit:fill; width:250px; height:200px; border: solid 1px #CCC">
                        <hr>
                    </div>
                    @endforeach
                    @endif
                </div>
              </div>
              {{$items->links()}}
        </div>
    </div>
</div>