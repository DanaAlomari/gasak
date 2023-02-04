@extends('front_end_layouts.app_layout')

@section('content')
@if(session()->has('success'))
    <script>
        alert({{ session()->get('success') }});
    </script>
@endif
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 offset-lg-2 text-center">
            <div class="breadcrumb-text">
              <p>See more Details</p>
              <h1>Single Product</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- single product -->
    <div class="single-product mt-150 mb-150">
      <div class="container">
        <div class="row">
          <div class="col-md-5">
            <div class="single-product-img">

               @if(isset($products->image) && file_exists($products->image))
                                            <img src="{{ asset($products->image) }}" alt=""/>
                                        @else
                                            <img src="https://sc04.alicdn.com/kf/H6305279c41c147cfbefc12277ff491876.png" alt=""/>
                                        @endif
            </div>
          </div>
          <div class="col-md-7">
            <div class="single-product-content">
              <h3>{{$products->name_en}}</h3>
              <p class="single-product-pricing"><span>{{$products->weight }} Kg</span> {{$products->sale_price}}JD</p>
              <p>
                {{$products->main_description_en }}
              </p>
              <div class="single-product-form">
                <form action="{{ route('customers.add-to-cart') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                  <input type="number" name="cart_product_quantity" placeholder="0" />



                <input type="hidden" name="cart_product_id"
                value="{{ encrypt($products->id) }}">
            {{-- <input type="hidden" name="cart_product_quantity"
                value="1"> --}}
                <button  title="Add To Cart" class="cart-btn"><i class="fas fa-shopping-cart"></i></button>
                {{-- <a href="{{ route('customers.add-to-cart') }}" class="cart-btn" --}}

                </form>
                <p><strong>Categories: </strong>{{$products->category->name_en }}</p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

@endsection
