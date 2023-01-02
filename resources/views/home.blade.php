@extends('layouts.app')

@section('content')


<style>
    .carousel-item {
        height: 32rem;
        background: #777;
        color: white;
        position: relative;
    }
    .container-carousel {
        position: absolute;
        bottom: 0;
        left: 50px;
        right: 0;
        padding-bottom: 50px;
    }
</style>

<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    
    <ol class="carousel-indicators">
        <li data-bs-target="#myCarousel"
        data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#myCarousel"
        data-bs-slide-to="1"></li>
        <li data-bs-target="#myCarousel"
        data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active" style="background-position: center center;
        background-repeat:no-repeat; background-image:url(./storage/images/cover.png);">
            <div class="container-carousel" style="margin-left:15%;">
                <h1>{{$categories[0]->category}}</h1>
                <p>Check out the items from this category!</p>
            </div>
        </div>
        <div class="carousel-item" style="background-position: center center;
        background-repeat:no-repeat; background-image:url(./storage/images/cover1.png);">
            <div class="container-carousel" style="margin-left:15%;">
                <h1>{{$categories[1]->category}}</h1>
                <a>Check out the items from this category!</a>
            </div>
        </div>
        <div class="carousel-item" style="background-position: center center;
        background-repeat:no-repeat; background-image:url(./storage/images/cover2.png);">
            <div class="container-carousel" style="margin-left:15%;">
                <h1>{{$categories[2]->category}}</h1>
                <a>Check out the items from this category!</a>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
</div>
<hr>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container">
                <div class="row">
                @foreach ($items as $item)
                    <div class="col-sm-4 img-portfolio">
                        <h3>
                            <a href="detail/{{$item['id']}}"><b>{{$item->name}}</b></a>
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
