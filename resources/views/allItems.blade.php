@include('layouts.app')

@section('content')


<div class="container mt-5">
    <table class="table table-striped">
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
                    <td><button class="btn-danger">Delete</button></td>
                    <td><button class="btn-warning">Edit</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex">
        {!! $items->links() !!}
    </div>
</div>