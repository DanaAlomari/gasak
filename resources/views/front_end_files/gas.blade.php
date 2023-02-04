@extends('front_end_layouts.app_layout')

@section('content')

    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 offset-lg-2 text-center">
            <div class="breadcrumb-text">
              <p>For order</p>
              <h1>{{ isset($category) ? $category->name_en : 'Shop' }}</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end breadcrumb section -->
    <div class="product-section mt-150 mb-150">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 offset-lg-2 text-center">
            <div class="section-title">
              <h3><span class="orange-text">Our</span> Products</h3>

            </div>
          </div>
        </div>

        <div class="row">
            @if(isset($products) && $products->count() > 0)
                @foreach ($products as $product)
                        <div class="col-lg-4 col-md-6 text-center">
                            <div class="single-product-item">
                                <div class="product-image">
                                    <a href="{{ route('product_details',[$product->id]) }}">
                                        @if(isset($product->image) && file_exists($product->image))
                                            <img src="{{ asset($product->image) }}" alt=""/>
                                        @else
                                            <img src="https://sc04.alicdn.com/kf/H6305279c41c147cfbefc12277ff491876.png" alt=""/>
                                        @endif
                                    </a>
                                </div>
                                <h3>{{$product->name_en}}</h3>
                                <p class="product-price"><span>{{$product->weight }} Kg</span> {{$product->sale_price}} JD</p>
                                <form action="{{route('customers.add-to-cart')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="cart_product_id" value="{{ encrypt($product->id) }}">
                                    <button type="submit" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                                </form>
                            </div>
                    </div>
                @endforeach
            @else
            <h1 class="text-danger">No Products Found ...</h1>
            @endif
        </div>
      </div>
    </div>
@endsection
