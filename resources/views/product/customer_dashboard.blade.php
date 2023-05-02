@extends('master')

@section('content')

<div class="col right-side" style="padding: 0">
    <div class="cart p-4">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Customer Dashboard</li>
        </ol>
      </nav>
    <div class="row">
        <div class="col-sm-4 p-3">
            <div class="rounded bg-white my-3 shadow">
            <div class="cart-detaits p-3" style="height:200px; !important">
                <p>Personal Profile</p>
                <hr />
                <a href="{{route('customer-profile',Session::get('userId'))}}"><i class="bi bi-pencil-square"></i></a>
                <p class="text-center mt-0 mb-0"><img height="80px" src="{{ asset('uploads/customer_img') }}/{{ Session::get('Image') }}" alt=""></p>
            </div>
            </div>
        </div>
        <div class="col-sm-4 p-3">
            <div class="rounded bg-white my-3 shadow">
            <div class="cart-detaits p-3"  style="height:200px; !important">
                <p>DEFAULT Information</p>
                <hr />

                <p>Name :<b>{{ Session::get('userName') }}</b></p>
                <p>Email :<b>{{ Session::get('userEmail') }}</b></p>
                <hr />
            </div>
            </div>
        </div>
        <div class="col-sm-4 p-3">
            <div class="rounded bg-white my-3 shadow">
            <div class="cart-detaits p-3"  style="height:200px; !important">
                <p>Address Book</p>
                <hr />
                <p>Address :<b>{{ Session::get('shippingAddress') }}</b></p>
                <p>Contact :<b>{{ Session::get('Phone') }}</b></p>
                <hr />
            </div>
            </div>
        </div>
    </div>
      <div class="prorduct-table">
        <div class="row">
            <p>Recent Orders</p>
            <hr />
          <div class="col-sm-12 p-3">
            <div class="rounded bg-white my-3 shadow p-2">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Subtotal</th>
                    <th class="col">Remove</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- @forelse ($carts as $cartitem)
                    <tr>
                        <td>
                          <img
                            class="img-fluid"
                            src="{{ asset('./../POS/') }}/{{ $cartitem->options->product_image }}"
                            alt=""
                          />
                        </td>
                        <td>{{ $cartitem->name }}</td>
                        <td>${{ $cartitem->price }}</td>
                        <td>
                            <strong class="ps-2">{{ $cartitem->qty }}</strong>
                        </td>
                        <td>${{ $cartitem->price*$cartitem->qty  }}</td>
                        <td>
                            <a href="{{ route('removefrom.cart',['cart_id' => $cartitem->rowId]) }}">
                                <i class="ms-3 text-danger bi bi-x-circle-fill"></i>
                            </a>
                        </td>
                      </tr>
                    @empty

                    @endforelse --}}

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
