@include('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit/Update Item</h4>
            <div class="card-body">
                <form action="{{route('admin.updateItem', $item->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <h5>Name</h5>
                    <input type="text" value={{$item->name}} name="name">
                    <br><br>
                    <h5>Category (originally: {{$item->category}})</h5>
                    <select name="category" id="category">
                        @foreach ($cats as $cat)
                            <option value="{{$cat->category}}">{{$cat->category}}</option>
                        @endforeach
                    </select>
                    <br><br>
                    <input type="number" name="price" step="0.01" min="0.01" max="2000" value="{{$item->price}}"> €
                    <br><br>
                    <textarea name="description" cols="30" rows="3">{{$item->description}}</textarea>
                    <br><br>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>