@extends('front_end_layouts.app_layout')

@section('content')

    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 offset-lg-2 text-center">
            <div class="breadcrumb-text">
              <p>Gasak</p>
              <h1>Cart</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- cart -->
    <div class="cart-section mt-150 mb-150">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-12">
            <div class="cart-table-wrap">
                <table class="cart-table">
                    <thead class="cart-table-head">
                        <tr class="table-head-row">
                            <th class="product-remove"></th>
                            <th class="product-image">Product Image</th>
                            <th class="product-name">Name</th>
                            <th class="product-price">Price</th>
                            <th class="product-quantity">Quantity</th>
                            <th class="product-total">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($public_customer_carts as $public_customer_cart)
                        <tr class="table-body-row">
                            <td class="product-remove">
                                <a href="{{ route('customers.delete-from-cart',$public_customer_cart->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                            <td class="product-image">
                                @if (isset($public_customer_cart->cart_product->image) && file_exists($public_customer_cart->cart_product->image))
                                <img style="height:100% !important;"
                                src="{{ asset($public_customer_cart->cart_product->image) }}"
                                alt="product">
                                @elseif(isset($public_customer_cart->cart_product->image_url))
                                <img style="height:100% !important;"
                                        src="{{ $public_customer_cart->cart_product->image_url }}"
                                        alt="product">
                                @else
                                <img style="height:100% !important;"
                                src="{{ asset('front_end_style/assets/images/product-image/6_1.jpg') }}"
                                alt="product">
                                @endif
                            </td>
                            <td class="product-name">{{ $public_customer_cart->product->name_en }}

                                <td class="product-price">{{ $public_customer_cart->cart_product->sale_price }}JD</td>
                                <td class="product-quantity">
                                            <form action="{{route('customers.updateCart')}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="cart_id" value="{{ $public_customer_cart->id }}" />
                                                <input type="number" placeholder="1" name="qty" value="{{ $public_customer_cart->quantity }}" min="1"/>
                                                <button type="submit" class="boxed-btn black">Update</button>
                                            </form>
                                        </td>
                                        <td class="product-total">{{ $public_customer_carts->endTotal }}JD</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="total-section">
              <table class="total-table">
                <thead class="total-table-head">
                  <tr class="table-total-row">
                    <th>Total</th>
                    <th>Price</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="total-data">
                    <td><strong>Subtotal: </strong></td>
                    <td>${{ $public_customer_carts->endTotal }}</td>
                  </tr>

                  <tr class="total-data">
                    <td><strong>Total: </strong></td>
                    <td>${{ $public_customer_carts->endTotal }}</td>
                  </tr>
                </tbody>
              </table>
              <div class="cart-buttons">

                <a href="{{ route('customers.checkoutPage') }}" class="boxed-btn black">Check Out</a>
              </div>
            </div>

            {{-- <div class="coupon-section">
              <h3>Apply Coupon</h3>
              <div class="coupon-form-wrap">
                <form action="{{ route('welcome') }}">
                  <p><input type="text" placeholder="Coupon" /></p>
                  <p><input type="submit" value="Apply" /></p>
                </form>
              </div>
            </div> --}}
          </div>
        </div>
      </div>
    </div>
    <!-- end cart -->



 @endsection
