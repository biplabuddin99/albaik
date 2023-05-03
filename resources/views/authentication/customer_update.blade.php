@extends('customer_master')

@section('content')
<div class="col right-side" style="padding: 0">
    <div class="form p-4">
      <div class="bg-white rounded shadow p-3">
        <p>Profile Update</p>
        <hr />
        <div class="m-auto my-3 w-50">
          <form action="{{route('customer.update',$customer->id)}}" method='post' enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="mb-3">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"
                    >First Name</label
                    >
                    <input
                    type="text"
                    class="form-control @error('first_name') is-invalid @enderror"
                    id="exampleInputEmail1"
                    name="first_name" value="{{ old('first_name',$customer->first_name) }}" placeholder="Enter Your First Name"
                    aria-describedby="emailHelp"
                    />
                    @if($errors->has('first_name'))
                        <small class="d-block text-danger">
                            {{$errors->first('first_name')}}
                        </small>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"
                    >Last Name</label
                    >
                    <input
                    type="text"
                    class="form-control @error('last_name') is-invalid @enderror"
                    id="exampleInputEmail1"
                    name="last_name" value="{{ old('last_name',$customer->last_name) }}" placeholder="Enter Your Last Name"
                    aria-describedby="emailHelp"
                    />
                    @if($errors->has('last_name'))
                    <small class="d-block text-danger">
                        {{ $errors->first('last_name') }}
                    </small>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"
                    >Mobile Number</label
                    >
                    <input
                    type="number"
                    class="form-control @error('contact') is-invalid @enderror"
                    id="exampleInputEmail1"
                    name="contact" value="{{ old('contact',$customer->contact) }}" placeholder="Enter Your Phone Number"
                    aria-describedby="emailHelp"
                    />
                    @if($errors->has('contact'))
                    <small class="d-block text-danger">
                        {{ $errors->first('contact') }}
                    </small>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"
                    >Shipping Address</label
                    >
                    <input
                    type="text"
                    class="form-control @error('shipping_address') is-invalid @enderror"
                    id="exampleInputEmail1"
                    name="shipping_address" value="{{ old('shipping_address',$customer->shipping_address) }}" placeholder="Enter Your Place"
                    aria-describedby="emailHelp"
                    />
                    @if($errors->has('shipping_address'))
                    <small class="d-block text-danger">
                        {{ $errors->first('shipping_address') }}
                    </small>
                    @endif
                </div>
                <div class="row m-0 p-0">
                    <div class="image-overlay">
                        <label  class="form-label" for="image">Customer Image</label>
                            <input type="file" name="image" value="" data-default-file="{{ asset('uploads/customer_img') }}/{{ $customer->image }}" class="form-control dropify">
                    </div>
                </div>
                </div>
                <button type="submit" class="submit shadow">Submit</button>
                {{-- <a class="submit shadow" href="#">Submit</a> --}}
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
