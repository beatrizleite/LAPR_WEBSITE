@include('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <ul>
            @foreach ($cats as $cat)
                <li>
                    <a href="{{route('categoriesid', $cat->id)}}">
                        {{$cat->category}}
                    </a>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
</div>