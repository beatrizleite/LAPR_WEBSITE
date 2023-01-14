@include('layouts.app')

@section('content')


<div class="container mt-5">
    <div class="d-flex justify-content-end">
        <button class="btn btn-primary"
        data-bs-toggle="modal" data-bs-target="#add">Add Item</button>
    </div>

    <div class="modal fade" id="add" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4></h4>
                    <form action="{{route('seller.addItem')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h5>Name</h5>
                        <input type="text" name="name">
                        <br><br>
                        <h5>Price</h5>
                        <input type="number" name="price" step="0.01" min="0.01" max="2000"> €
                        <br><br>
                        <h5>Description</h5>
                        <textarea name="description" cols="30" rows="3"></textarea>
                        <h5>Category</h5>
                        <select name="cat" id="type">
                            @foreach ($cats as $cat)
                                <option value="{{$cat->category}}">{{$cat->category}}</option>
                            @endforeach
                        </select>
                        <br><br>
                        <h5>Image</h5>
                        <input type="file" name="image">
                        <br><br>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-striped">
        <caption>All items table</caption>
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Vendor ID</th>
                <th scope="col">Delete</th>
                <th scope="col">Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category }}</td>
                    <td>{{ $item->vendor }}</td>
                    <td>
                    <form action="{{route('seller.deleteItem', ['id' => $item->id])}}" method="get">
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                    </form>
                    </td>
                    <form action="{{route('seller.editItem', ['id' => $item->id])}}" method="get">
                        @csrf
                        <td>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit">
                                Edit
                            </button>
                        </td>
                    </form>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex">
        {!! $items->links() !!}
    </div>
</div>