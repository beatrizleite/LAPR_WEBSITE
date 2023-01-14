@include('layouts.app')

@section('content')

    <div class="container">
        <hr>
        <form action="{{ route('placeOrder') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>Details</h6>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">First Name</label>
                                    <input type="text" required class="form-control" name="firstname">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Last Name</label>
                                    <input type="text" required class="form-control" name="lastname">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Phone Number</label>
                                    <input type="text" required class="form-control" name="phone">
                                </div>
                                <div class="col-md-6 mt-3" mt-3>
                                    <label for="">Address</label>
                                    <input type="text" required class="form-control" name="address">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">City</label>
                                    <input type="text" required class="form-control" name="city">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Country</label>
                                    <input type="text" required class="form-control" name="country">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Postal Code</label>
                                    <input type="text" required class="form-control" name="postcode">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Order details</h6>
                            <hr>
                            <table class="table table-striped">
                                <caption>Cart items table</caption>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <?php $total = 0; ?>
                                <tbody>
                                    @foreach ($cartitems as $item)
                                        <?php $total += $item->items->price; ?>
                                        <tr>
                                            <td>{{ $item->items->name }}</td>
                                            <td>{{ $item->items->price }}€</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>Total:</td>
                                        <td>{{ $total }}€</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <button type="submit" class="btn btn-outline-success">Proceed to payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
