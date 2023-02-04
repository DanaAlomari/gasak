@extends('front_end_layouts.app_layout')

@section('content')
    <!-- breadcrumb-section -->
    <div class="breadcrumb-section breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <div class="breadcrumb-text">
                        <p>Fresh and Organic</p>
                        <h1>Check Out Product</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb section -->

    <!-- check out section -->
    <div class="checkout-section mt-150 mb-150">
        <div class="container">
            <form action="{{ route('customers.checkout') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="row">

                <div class="col-lg-8">
                    <div class="checkout-accordion-wrap">
                        <div class="accordion" id="accordionExample">
                            <div class="card single-accordion">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Billing Address
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="billing-address-form">
                                            <p><input class="form-control" type="text" placeholder="Name" name="name" /></p>
                                            <p><input class="form-control" type="email" placeholder="Email" name="email" /></p>
                                            <p><input class="form-control" type="text" placeholder="Address" name="address" /></p>
                                            <p><input class="form-control" type="tel" placeholder="Phone" name="phone" /></p>
                                            <p>
                                                <textarea class="form-control" name="more_details" name="bill" id="bill" cols="30" rows="10" placeholder="Say Something"></textarea>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card single-accordion">

                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shipping-address-form">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card single-accordion">

                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="card-details">
                                            <p>Your card details goes here.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="order-details-wrap">
                        <table class="order-details">
                            <thead>
                                <tr>
                                    <th>Your order Details</th>
                                    <th>Price</th>
                                </tr>
                            </thead>

                            <tbody class="checkout-details">
                                <tr>
                                    <td>Subtotal</td>
                                    <td>{{ $public_customer_carts->endTotal }}JD</td>
                                </tr>

                                <tr>
                                    <td>Total</td>
                                    <td>{{ $public_customer_carts->endTotal }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="boxed-btn">Place Order</button>
                    </div>
                </div>

            </div>
        </form>
        </div>
    </div>
    <!-- end check out section -->
@endsection
