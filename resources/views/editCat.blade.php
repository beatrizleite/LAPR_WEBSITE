@include('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit/Update Category</h4>
            <div class="card-body">
                <h4>Category's name</h4>
                <form action="{{route('admin.updateCat', $cat->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" value={{$cat->category}} name="category"><br><br>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>