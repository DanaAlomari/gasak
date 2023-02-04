@extends('front_end_layouts.app_layout')

@section('content')

    <!-- home page slider -->
    <div class="homepage-slider">
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-1">
          <div class="container">
            <div class="row">
              <div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
                <div class="hero-text">
                  <div class="hero-text-tablecell">
                    <p class="subtitle">FOR ORDER</p>
                    <h1>Gas cylinder</h1>
                    <div class="hero-btns">
                      <a href="./Gas.html" class="boxed-btn">Gas cylinder</a>
                      <a href="contact.html" class="bordered-btn">Contact Us</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-2">
          <div class="container">
            <div class="row">
              <div class="col-lg-10 offset-lg-1 text-center">
                <div class="hero-text">
                  <div class="hero-text-tablecell">
                    <p class="subtitle">FOR ORDER</p>
                    <h1>Linear Gas</h1>
                    <div class="hero-btns">
                      <a href="./shop.html" class="boxed-btn">Visit Shop</a>
                      <a href="contact.html" class="bordered-btn">Contact Us</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- single home slider -->
        <div class="single-homepage-slider homepage-bg-3">
          <div class="container">
            <div class="row">
              <div class="col-lg-10 offset-lg-1 text-right">
                <div class="hero-text">
                  <div class="hero-text-tablecell">
                    <p class="subtitle">FOR SERVICES</p>
                    <h1>Appointment</h1>
                    <div class="hero-btns">
                      <a href="./Services.html" class="boxed-btn">Visit SERVICES</a>
                      <a href="contact.html" class="bordered-btn">Contact Us</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end home page slider -->

      <!-- features list section -->
      <div class="list-section pt-80 pb-80">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
              <div class="list-box d-flex align-items-center">
                <div class="list-icon">
                  <i class="fas fa-shipping-fast"></i>
                </div>
                <div class="content">
                  <h3>Fast delivery of orders</h3>
                  <p>
                    Our ordering system depends on delivering the order to the
                    nearest driver in your area based on the use of Google Maps
                    for ordering and delivery
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
              <div class="list-box d-flex align-items-center">
                <div class="list-icon">
                  <i class="fas fa-phone-volume"></i>
                </div>
                <div class="content">
                  <h3>Quality and safety guarantee</h3>
                  <p>
                    A specialist checks your security system upon delivery of the
                    order and detects any defects to ensure quality and safety
                    control
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
              <div
                class="list-box d-flex justify-content-start align-items-center"
              >
                <div class="list-icon">
                  <i class="fas fa-sync"></i>
                </div>
                <div class="content">
                  <h3>Easy to order and pay</h3>
                  <p>
                    Enjoy an easy system based on the principles of user
                    experience design that achieves you a great and easy user
                    experience using our system
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end features list section -->

      <!-- product section -->
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
            {{-- <div class="col-lg-4 col-md-6 text-center">
              <div class="single-product-item">
                <div class="product-image">
                  <a href="single-product.html"
                    ><img
                      src="https://sc04.alicdn.com/kf/Hc49a3fb3e1a345ff9ca017a43b23f85bn.jpg"
                      alt=""
                  /></a>
                </div>
                <h3>Gas cylinder</h3>
                <p class="product-price"><span>10 Kg</span> 12JD</p>
                <a href="cart.html" class="cart-btn"
                  ><i class="fas fa-shopping-cart"></i> Add to Cart</a
                >
              </div>
            </div>
            <div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0 text-center">
              <div class="single-product-item">
                <div class="product-image">
                  <a href="single-product.html"
                    ><img
                      src="https://sc04.alicdn.com/kf/H7dda8d796cde4ea5a7d31df5ece95d4dF.jpg"
                      alt=""
                  /></a>
                </div>
                <h3>Gas cylinder</h3>
                <p class="product-price"><span>10 Kg</span>12JD</p>
                <a href="cart.html" class="cart-btn"
                  ><i class="fas fa-shopping-cart"></i> Add to Cart</a
                >
              </div>
            </div> --}}
          </div>
        </div>
      </div>





      <!-- advertisement section -->
      <div class="abt-section mb-150">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <div class="abt-bg">
                <a
                  href="https://www.youtube.com/watch?v=Q08_osZdSGQ"
                  class="video-play-btn popup-youtube"
                  ><i class="fas fa-play"></i
                ></a>
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="abt-text">
                <!-- <p class="top-sub">Since Year 1999</p> -->
                <h2>Gas Cylinder <span class="orange-text"> Safety</span></h2>
                <p>
                  Never intentionally drop or strike compressed gas cylinders
                  against one another. Do not use a compressed gas in a confined
                  space. Never use a leaking, corroded or damaged cylinder. Remove
                  the cylinder from service and contact the supplier for return.
                </p>
                <p>
                  Keep cylinder valves closed except when the cylinder is being
                  used. When opening a cylinder valve, stand so that the valve
                  outlet is pointed away from yourself and all other employees.
                  Open valves slowly.
                </p>
                <a href="about.html" class="boxed-btn mt-4">know more</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end advertisement section -->

      <!-- shop banner -->
      <section class="shop-banner">
        <div class="container">
          <h3>
             <br />
             <span class="orange-text"></span>
          </h3>
          <div class="sale-percent">
            <span
              > <br />
              </span
            ><span></span>
          </div>
          <a href="shop.html" class="cart-btn btn-lg">Shop Now</a>
        </div>
      </section>
      <!-- end shop banner -->
      <div class="product-section mt-150 mb-150">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
              <div class="section-title">
                <h3><span class="orange-text">Our </span> products</h3>

              </div>
            </div>
          </div>

          <div class="row">

            @if(isset($products1) && $products1->count() > 0)
            @foreach ($products1 as $product1)

            <div class="col-lg-4 col-md-6 text-center">
                <form action="{{ route('customers.add-to-cart') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                {{-- <input type="number" name="cart_product_quantity" placeholder="0" /> --}}



                <input type="hidden" name="cart_product_id" value="{{ encrypt($product1->id) }}">
              <div class="single-product-item">
                <div class="product-image">
                    <a href="{{ route('product_details',[$product1->id]) }}">
                        @if(isset($product1->image) && file_exists($product1->image))
                            <img src="{{ asset($product1->image) }}" alt=""/>
                        @else
                            <img src="https://sc04.alicdn.com/kf/H6305279c41c147cfbefc12277ff491876.png" alt=""/>
                        @endif
                    </a>
                </div>
                <h3>{{$product1->name_en}}</h3>
                <p class="product-price"><span>{{$product1->weight }} Kg</span> {{$product1->sale_price}} JD</p>
                <button type="submit" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
            </div>
                </form>
            </div>
            @endforeach
            @else
            <h1 class="text-danger">No Products Found ...</h1>
            @endif

          </div>
        </div>
      </div>

@endsection
