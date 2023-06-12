@extends('customer_master')

@section('content')
<div class="col right-side" style="padding: 0">
    <div class="form p-4">
      <div class="bg-white rounded shadow p-3">
        <p>Profile Update</p>
        <hr />
        <div class="m-auto my-3 w-50">
          <form action="{{route('customer.update')}}" method='post' enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="mb-3">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"
                    >First Name</label
                    >
                    <input
                    type="text"
                    class="form-control @error('customer_name') is-invalid @enderror"
                    id="exampleInputEmail1"
                    name="customer_name" value="{{ old('customer_name',$customer->customer_name) }}" placeholder="Enter Your Name"
                    aria-describedby="emailHelp"
                    />
                    @if($errors->has('customer_name'))
                        <small class="d-block text-danger">
                            {{$errors->first('customer_name')}}
                        </small>
                    @endif
                </div>
                {{--  <div class="mb-3">
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
                </div>  --}}
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"
                    >Mobile Number</label
                    >
                    <input
                    type="number"
                    class="form-control @error('mobile') is-invalid @enderror"
                    id="exampleInputEmail1"
                    name="mobile" value="{{ old('mobile',$customer->mobile) }}" placeholder="Enter Your Phone Number"
                    aria-describedby="emailHelp"
                    />
                    @if($errors->has('mobile'))
                    <small class="d-block text-danger">
                        {{ $errors->first('mobile') }}
                    </small>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"
                    >Address</label
                    >
                    <input
                    type="text"
                    class="form-control @error('address') is-invalid @enderror"
                    id="exampleInputEmail1"
                    name="address" value="{{ old('address',$customer->address) }}" placeholder="Enter Your Place"
                    aria-describedby="emailHelp"
                    />
                    @if($errors->has('address'))
                    <small class="d-block text-danger">
                        {{ $errors->first('address') }}
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
