@include('layouts.app')

@section('content')


<div class="container mt-5">
    <div class="d-flex justify-content-end"><button class="btn btn-primary"
        data-bs-toggle="modal" data-bs-target="#add">Add Category</button>
    </div>

    <div class="modal fade" id="add" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Category</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>Category's name</h4>
                    <form action="{{route('admin.addCat')}}" method="POST">
                        @csrf
                        <input type="text" name="category"><br><br>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Delete</th>
                <th scope="col">Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cats as $cat)
                <tr>
                    <th scope="row">{{ $cat->id }}</th>
                    <td>{{ $cat->category }}</td>
                    <td>
                    <form action="{{route('admin.deleteCat', ['id' => $cat->id])}}" method="get">
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                    </form>
                    </td>
                    <form action="{{route('admin.editCat', ['id' => $cat->id])}}" method="get">
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
        {!! $cats->links() !!}
    </div>
</div>