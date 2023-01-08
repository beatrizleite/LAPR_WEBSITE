@include('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit/Update Item</h4>
            <div class="card-body">
                <form action="{{route('admin.updateUser', $user->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <h5>Name</h5>
                    <input type="text" value={{$user->name}} name="name">
                    <br><br>
                    <select name="type" id="type">
                        <option value="0">Normal</option>
                        <option value="1">Seller</option>
                        <option value="2">Admin</option>
                    </select>
                    <br><br>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>