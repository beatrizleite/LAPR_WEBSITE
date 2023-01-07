@include('layouts.app')

@section('content')


<div class="container mt-5">
    <div class="d-flex justify-content-end"><button class="btn btn-primary">Add Category</button></div>
    
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
                    <td><button class="btn btn-danger">Delete</button></td>
                    <td><button class="btn btn-warning">Edit</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex">
        {!! $cats->links() !!}
    </div>
</div>