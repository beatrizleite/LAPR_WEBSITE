@include('layouts.app')

@section('content')


<div class="container mt-5">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Delete</th>
                <th scope="col">Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><button class="btn-danger">Delete</button></td>
                    <td><button class="btn-warning">Edit</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex">
        {!! $users->links() !!}
    </div>
</div>