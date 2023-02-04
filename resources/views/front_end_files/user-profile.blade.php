@extends('front_end_layouts.app_layout')



@section('admin_css')
    <link href="{{ asset('dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_files/assets/css/sleek.min.css') }}">
@endsection


@section('content')
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 offset-lg-2 text-center">
          <div class="breadcrumb-text">
            <h1>User Profile</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

    <!-- User profile section -->
    <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p py-5">
        <div class="container">
            <div class="row">


                <div class="nav flex-column nav-pills col-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                        <a class="nav-link active" href="{{ route('customers.profile') }}">Update Profile</a>
                        <a class="nav-link" href="{{route('customers.cart')}}">Cart</a>
                        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Invoices</a>

                </div>
                <div class="col-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="ec-vendor-card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="ec-vendor-block-profile">
                                            <div class="ec-vendor-block-img space-bottom-30">

                                                <div class="ec-vendor-block-detail">
                                                    @if(isset(auth('customers')->user()->profile_photo_path) && file_exists(auth('customers')->user()->profile_photo_path))
                                                    <img class="v-img"
                                                        src="{{ asset(auth('customers')->user()->profile_photo_path) }}"
                                                        alt="vendor image" id="img">
                                                        @else
                                                        <img class="v-img"
                                                            src="http://bootdey.com/img/Content/avatar/avatar1.png"
                                                            alt="vendor image" id="img">
                                                        @endif
                                                    <h5 class="name">{{ auth('customers')->user()->name_en }}</h5>

                                                </div>
                                                <p>Hello <span>{{ auth('customers')->user()->name_en }}!</span></p>

                                            </div>
                                            <form action="{{ Route('customers.update-profile') }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <h5>Account Information</h5>
                                                <input type="hidden" name="id" value="{{auth('customers')->user()->id}}">
                                                <div class="row">
                                                    <div class="mb-3 col-md-6">
                                                        <label for="name_en"
                                                            class="small mb-1">user name</label>
                                                        <div class="form-outline ">
                                                            <input id="name_en" type="text"
                                                                placeholder="Enter your name"
                                                                class="form-control @error('name_en') is-invalid @enderror"
                                                                name="name_en" value="{{ auth('customers')->user()->name_en }}"
                                                                required autocomplete="name_en" autofocus>
                                                            @error('name_en')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>



                                                    <div class="mb-3 col-md-6">
                                                        <label for="email"
                                                            class="small mb-1">email
                                                        </label>
                                                        <div class="input-group mb-3">
                                                            <input id="email" type="text"
                                                                placeholder="Enter your email"
                                                                class="form-control @error('email') is-invalid @enderror"
                                                                name="email" value="{{ auth('customers')->user()->email }}"
                                                                required autocomplete="email" autofocus>
                                                            <span class="input-group-text" id="basic-addon2">@</span>

                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                        <div class="mb-3 col-md-6 ">
                                                            <label for="phone"
                                                                class="small mb-1">phone
                                                            </label>
                                                            <div class="input-group mb-3">
                                                                <input id="phone" type="text"
                                                                    placeholder="Enter your phone"
                                                                    class="form-control @error('phone') is-invalid @enderror"
                                                                    name="phone" value="{{ auth('customers')->user()->phone }}"
                                                                    required autocomplete="phone" autofocus>
                                                                @error('phone')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="password_confirmation"
                                                                class="small mb-1">Profile Photo
                                                            </label>
                                                            <div class="input-group mb-3">
                                                                <input id="profile_photo_path" type="file"
                                                                    class="form-control @error('profile_photo_path') is-invalid @enderror"
                                                                    name="profile_photo_path" value="" autofocus>
                                                                @error('profile_photo_path')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="password"
                                                                class="small mb-1">password
                                                            </label>
                                                            <div class="input-group mb-3">
                                                                <input id="password" type="password"
                                                                    placeholder="Enter your password"
                                                                    class="form-control @error('password') is-invalid @enderror"
                                                                    name="password" value=""
                                                                    autocomplete="password" autofocus>
                                                                @error('password')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mb-3">
                                                            <label for="password_confirmation"
                                                                class="small mb-1">password confirmation
                                                            </label>
                                                            <div class="input-group mb-3">
                                                                <input id="password_confirmation" type="password"
                                                                    placeholder="Enter your Confirm Password"
                                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                                    name="password_confirmation" value=""
                                                                    autocomplete="password_confirmation" autofocus>
                                                                @error('password_confirmation')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>



                                                        <div class="col-md-12 mb-3">
                                                    <input class="btn btn-primary" type="submit"
                                                        value="submit" />
                                                        </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                            <div class="ec-vendor-card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="ec-vendor-block-profile">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Date/Time</th>
                                                        <th>Items</th>
                                                        <th>Total</th>
                                                        <th>###</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (isset($orders))
                                                        @if ($orders->count() > 0)
                                                            @foreach ($orders as $key => $order)
                                                                <tr>
                                                                    <td>{!! isset($key) ? $key + 1 : "<span style='color:rgb(83, 83, 83);'>Undefined</span>" !!}</td>
                                                                    <td>{{ date('Y.d.m / h:i A', strtotime($order->created_at)) }}</td>
                                                                    <td>{{ $order->cartOperations->count() }} Items</td>
                                                                    <td>{!! isset($order->total) ? $order->total . '<small> $</small>' : "<span style='color:red;'>Undefined</span>" !!}</td>
                                                                    <td><button class="btn btn-sm btn-secondary show_order" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{$order->id}}"><i class="fa fa-info"></i></button></td>
                                                                </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td colspan="6"><h4 class="text-dangewr">No Orders</h4></td>
                                                                </tr>
                                                            @endif
                                                            @else
                                                                <tr>
                                                                    <td colspan="6"><h4 class="text-dangewr">No Orders</h4></td>
                                                                </tr>
                                                        @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Order Details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="order_body">
                        <div class="tab-pane fade show active" id="tab_1" role="tabpanel" aria-labelledby="timeline-tab">
                            <div class="media mt-3 profile-timeline-media">
                                <div class="media-body">
                                    <h3 class="py-3 text-dark"><i class="mdi mdi-information"></i> Main Order Information :
                                    </h3>
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th><i class="mdi mdi-account"></i> Order ID: <span
                                                        style="color:blue;">{!! isset($cartSale->id) ? $cartSale->id : '<span style="color:red;">Undefined</span>' !!}</span></th>
                                                <th><i class="mdi mdi-account"></i> Number Of Product : <span
                                                        style="color:blue;">{!! isset($cartSale->product_count)
                                                            ? $cartSale->product_count . ' products'
                                                            : '<span style="color:red;">Undefined</span>' !!}</span></th>
                                            </tr>
                                            <tr>
                                                <th><i class="mdi mdi-account"></i> Sub Total : <span
                                                        style="color:blue;">{!! isset($cartSale->total)
                                                            ? $cartSale->sub_total . '<small> $</small>'
                                                            : '<span style="color:red;">Undefined</span>' !!}</span></th>
                                                <th><i class="mdi mdi-account"></i> Total : <span
                                                        style="color:blue;">{!! isset($cartSale->total)
                                                            ? $cartSale->total . '<small> $</small>'
                                                            : '<span style="color:red;">Undefined</span>' !!}</span></th>
                                            </tr>
                                            <tr>

                                                <th><i class="mdi mdi-phone"></i> Customer Name : <span style="color:blue;">
                                                        @if (isset($cartSale->name))
                                                            {{ $cartSale->name }}

                                                        @else
                                                            <span style="color:red;">Undefined</span>
                                                        @endif
                                                    </span></th>
                                            </tr>

                                            <tr>
                                                <th><i class="mdi mdi-account-multiple"></i> Customer Email : <span
                                                        style="color:blue;">
                                                        @if (isset($cartSale->email))
                                                            {{ $cartSale->email }}
                                                        @else

                                                                <span style="color:red;">Undefined</span>
                                                        @endif
                                                    </span></th>
                                                <th><i class="mdi mdi-phone"></i> Customer Phone : <span
                                                        style="color:blue;">
                                                        @if(isset($cartSale->phone))
                                                                {{ $cartSale->phone }}
                                                        @else
                                                                <span style="color:red;">Undefined</span>
                                                        @endif
                                                    </span>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th><i class="mdi mdi-phone"></i> Customer Address : <span
                                                        style="color:blue;">
                                                        @if(isset($cartSale->address))
                                                                {{ $cartSale->address }}
                                                        @else
                                                                <span style="color:red;">Undefined</span>
                                                        @endif
                                                    </span>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th><i class="mdi mdi-clock-outline mdi-spin"></i> Order Added Since : <span
                                                        style="color:blue;">{!! isset($cartSale->created_at)
                                                            ? $cartSale->created_at->diffForHumans()
                                                            : '<span style="color:red;">Undefined</span>' !!}</span></th>
                                                <th><i class="mdi mdi-clock-outline mdi-spin"></i> Date & Time of Addtion :
                                                    <span style="color:blue;">{!! isset($cartSale->created_at)
                                                        ? date('Y.d.m / h:i A', strtotime($cartSale->created_at))
                                                        : '<span style="color:red;">Undefined</span>' !!}</span>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>


                            {{-- ================================================= --}}
                            {{-- =========== payments Information ============ --}}
                            {{-- ================================================= --}}
                            <div class="media mt-3 profile-timeline-media">
                                <div class="media-body">
                                    {{-- ================================================= --}}
                                    {{-- ================== Order Details ================ --}}
                                    {{-- ================================================= --}}
                                    <h3 class="py-3 text-dark"><i class="mdi mdi-information"></i> Order Details :
                                    </h3>
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th><span style="color:blue;">Image</th>
                                                <th><span style="color:blue;">Product</th>
                                                <th><span style="color:blue;">Quantity</th>
                                                <th><span style="color:blue;">Price</th>
                                                <th><span style="color:blue;">Sub Total</th>
                                                <th><span style="color:blue;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($cartSale->cartOperations) && $cartSale->cartOperations->count())
                                                @foreach ($cartSale->cartOperations as $cartOperation)
                                                    <tr>
                                                        <td>
                                                            @if (isset($cartOperation->product->image) && file_exists($cartOperation->product->image))
                                                                <img src="{{ asset($cartOperation->product->image) }}"
                                                                    alt="" width="90">
                                                            @else
                                                                <img src="{{ asset('front_end_style/images/default.png') }}"
                                                                    alt="" width="100">
                                                            @endif
                                                        </td>
                                                        <td><a
                                                                href="{{ route('super_admin.products-show', $cartOperation->product_id) }}">{!! isset($cartOperation->product->name_en)
                                                                    ? $cartOperation->product->name_en
                                                                    : '<span style="color: red;">Undefined</span>' !!}</a>
                                                        </td>
                                                        <td>{{ isset($cartOperation->quantity) ? $cartOperation->quantity : 0 }}
                                                        </td>
                                                        <td>{!! isset($cartOperation->product->sale_price)
                                                            ? $cartOperation->product->sale_price . '<small> $</small>'
                                                            : '<span style="color: red;">Undefined</span>' !!}</td>
                                                        <td>{!! isset($cartOperation->quantity) && isset($cartOperation->product->sale_price)
                                                            ? $cartOperation->quantity * $cartOperation->product->sale_price . '<small> $</small>'
                                                            : '<span style="color: red;">Undefined</span>' !!}</td>
                                                        <td>{!! isset($cartOperation->quantity) && isset($cartOperation->product->sale_price)
                                                            ? $cartOperation->quantity * $cartOperation->product->sale_price . '<small> $</small>'
                                                            : '<span style="color: red;">Undefined</span>' !!}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        <tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
            </div>
    </section>
    <!-- End User profile section -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        // file_img.onchange = evt => {
        //     const [file] = file_img.files;
        //     if (file) {
        //         img.src = URL.createObjectURL(file);
        //         document.getElementById('submit').click();
        //     }
        // }



        $("#invoice_link").on('click',function(){
            $("#user_tab").css('display','none');
            $("#invoice_tab").css('display','');
        });


        $(document).on('click','.show_order',function(e){
            e.preventDefault();

            data_id = $(this).data('id');

                formData = new FormData();
                formData.append('sale_id', data_id);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: "{{ route('customers.getOrderDetails') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        if (data['status'] == true) {
                            $("#order_body").html('');
                            $("#order_body").html(data['output']);

                        } else {
                            swal({
                                icon: 'error',
                                title: 'Ooops',
                                text: data.output,
                                width: 400,
                            })
                        }
                    },
                    error: function(data) {
                        swal({
                            icon: 'error',
                            title: 'Ooops',
                            text: data.msg,
                            width: 400,
                        })
                    }
                });
        });

    </script>
@endsection
