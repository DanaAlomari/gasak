@extends('admin.layouts.app')

{{-- @section('admin_css')
    <link href="{{ asset('resources/dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('resources/dashboard_files/assets/css/sleek.min.css') }}">
@endsection --}}

@section('content')

    {{-- ============================================== --}}
    {{-- ================== Header ==================== --}}
    {{-- ============================================== --}}
    <div class="breadcrumb-wrapper breadcrumb-contacts">
        <div>
            <h1><i class="mdi mdi-account-multiple"></i> Order Details</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('super_admin.dashboard') }}">
                            <i class="mdi  mdi-home"></i> Dashboard
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('super_admin.orders-index') }}">
                            <i class="mdi  mdi-account-multiple"></i> All Orders
                        </a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page"><i class="mdi  mdi-account-multiple"></i> Order Details
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="bg-white border rounded">
        <div class="row no-gutters">

            {{-- =========================================================== --}}
            {{-- ================== Sweet Alert Section ==================== --}}
            {{-- =========================================================== --}}
            <div>
                @if (session()->has('success'))
                    <script>
                        swal("Great Job !!!", "{!! Session::get('success') !!}", "success", {
                            button: "OK",
                        });
                    </script>
                @endif
                @if (session()->has('danger'))
                    <script>
                        swal("Oops !!!", "{!! Session::get('danger') !!}", "error", {
                            button: "Close",
                        });
                    </script>
                @endif
            </div>

            {{-- ================================================================================================= --}}
            {{-- ========================================== Right Section ========================================= --}}
            {{-- ================================================================================================= --}}
            <div class="col-lg-12 col-xl-12">
                <div class="profile-content-right py-5">
                    {{-- ================================================================================================= --}}
                    {{-- ===================================== Tabs Bodies Section ======================================= --}}
                    {{-- ================================================================================================= --}}
                    <div class="tab-content px-3 px-xl-5" id="myTabContent">

                        {{-- ============================================== --}}
                        {{-- ============= All Error Messages ============= --}}
                        {{-- ============================================== --}}
                        <div class="mt-3">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <h3>Please correct the following errors : </h3>
                                    <hr>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>- {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        {{-- ============================================================================== --}}
                        {{-- =========================== Product Info Tab Body ============================ --}}
                        {{-- ============================================================================== --}}
                        <div class="tab-pane fade show active" id="tab_1" role="tabpanel"
                            aria-labelledby="timeline-tab">

                            {{-- ================================================= --}}
                            {{-- =========== Main Product Information ============ --}}
                            {{-- ================================================= --}}
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
                                                        ? $cartSale->total . '<small> $</small>'
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
                                                <th><span style="color:blue;">Unit Price</th>
                                                <th><span style="color:blue;">Sub Total</th>
                                                <th><span style="color:blue;">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($cartSale->cartOperations) && $cartSale->cartOperations->count())
                                                @foreach ($cartSale->cartOperations as $cartOperation)
                                                    <tr>
                                                        <td>
                                                            @if (isset($cartOperation->product->image) &&
                                                                $cartOperation->product->image &&
                                                                file_exists($cartOperation->product->image))
                                                                <img src="{{ asset($cartOperation->product->image) }}"
                                                                    alt="" width="90">
                                                            @elseif (isset($cartOperation->product->image_url) && $cartOperation->product->image_url != null)
                                                                <img src="{{ $cartOperation->product->image_url }}"
                                                                    alt="" width="90">
                                                            @else
                                                                <img src="{{ asset('front_end_style/images/default.png') }}"
                                                                    alt="" width="100">
                                                            @endif
                                                        </td>
                                                        <td>{!! isset($cartOperation->product->name_en)
                                                                    ? $cartOperation->product->name_en
                                                                    : '<span style="color: red;">Undefined</span>' !!}
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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('admin_javascript')
    <script>
        jQuery(document).ready(function() {
            jQuery('#hoverable-data-table_1').DataTable({
                "aLengthMenu": [
                    [20, 30, 50, 75, -1],
                    [20, 30, 50, 75, "All"]
                ],
                "pageLength": 20,
                "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',
                "order": [
                    [2, "desc"]
                ]
            });
            jQuery('#hoverable-data-table_2').DataTable({
                "aLengthMenu": [
                    [20, 30, 50, 75, -1],
                    [20, 30, 50, 75, "All"]
                ],
                "pageLength": 20,
                "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">',
                "order": [
                    [2, "desc"]
                ]
            });
        });
    </script>
    <script src="{{ asset('dashboard_files/assets/plugins/data-tables/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.js') }}"></script>
@endsection
