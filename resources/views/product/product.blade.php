@extends('master')

@section('content')

        <!-- right side div start -->
        <div class="col right-side" style="padding: 0">
            <!-- product Row 1 start-->
            <div class="container product-row-1 my-4">
              <div class="product-heading">
                <div class="row">
                  <!-- Breadcrumb start -->
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item fw-bold"><a class="navigation-a" href="{{ route('home') }}">Home</a></li>
                      <li class="breadcrumb-item fw-bold"><a class="navigation-a" href="#">Category</a></li>
                      <li class="breadcrumb-item active fw-bold" aria-current="page">
                        Product
                      </li>
                    </ol>
                  </nav>
              <!-- Breadcrumb ends -->
                </div>
              </div>

              <div class="product-row my-3">

                <div class="row justify-content-center">
                    @forelse ($product as $p)
                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                        <div class="card shadow mb-3">
                          <a href="#">
                            <a href="{{ route('product_details.singleProduct',$p->id) }}">
                          <img class="card-img-top" src="{{ asset('./../pos/') }}/{{ $p->item_image }}" width="200px" height="200px"/>
                          </a>
                          <div class="card-body">
                            <p class="card-title text-center">{{ $p->item_name }}</p>
                            <p class="card-title text-center m-0 p-0">{{ $p->sales_price .' '.'TK' }}</p>
                            <div class="card-button">
                              <a href="#">+ Add to Card</a>
                              <a href="#"><i class="bi bi-heart-fill"></i></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    @empty
                        <h3 class="text-center m-5">No Product Found</h3>
                    @endforelse
                    {{ $product->links() }}

                </div>
              </div>
            </div>
          </div>
@endsection
