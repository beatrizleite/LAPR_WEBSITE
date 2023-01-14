@include('layouts.app')

@section('content')


<div class="container mt-5">
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
                    <form action="{{route('admin.deleteItem', ['id' => $item->id])}}" method="get">
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                    </form>
                    </td>
                    <form action="{{route('admin.editItem', ['id' => $item->id])}}" method="get">
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