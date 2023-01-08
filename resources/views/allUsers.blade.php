@include('layouts.app')

@section('content')


<div class="container mt-5">
    <div class="d-flex justify-content-end"><button class="btn btn-primary"
        data-bs-toggle="modal" data-bs-target="#add">Add User</button>
    </div>

    <div class="modal fade" id="add" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <form action="{{route('admin.addUser')}}" method="POST">
                        @csrf
                        <h5>Name</h5>
                        <input type="text" name="name">
                        <br><br>
                        <h5>E-mail</h5>
                        <input type="text" name="email">
                        <br><br>
                        <h5>Password</h5>
                        <input type="password" name="password">
                        <br><br>
                        <h5>Type</h5>
                        <select name="type" id="type">
                            <option value="0">Normal</option>
                            <option value="1">Seller</option>
                            <option value="2">Admin</option>
                        </select>
                        <br><br>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Type</th>
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
                    <td>
                        @if ($user->type == 0)
                            Normal
                        @elseif ($user->type == 1)
                            Seller
                        @elseif ($user->type == 2)
                            Admin
                        @endif
                    </td>
                    <td>
                        <form action="{{route('admin.deleteUser', ['id' => $user->id])}}" method="get">
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                    </form>
                    </td>
                    <form action="{{route('admin.editUser', ['id' => $user->id])}}" method="get">
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
        {!! $users->links() !!}
    </div>
</div>