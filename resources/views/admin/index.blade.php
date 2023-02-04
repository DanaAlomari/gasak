@extends('admin.layouts.app')

@section('content')
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

    {{-- ====================================================================== --}}
    {{-- =========================== All Counters ============================= --}}
    {{-- ====================================================================== --}}
    <div class="row">
        <div class="col-xl-6 col-sm-6">
            <div class="card card-mini mb-4">
                <div class="card-body">
                    <h2 class="mb-1">0</h2>
                    <h5 style="color: blue;"><i class="mdi mdi-star mdi-spin"></i> All Customers</h5>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6">
            <div class="card card-mini  mb-4">
                <div class="card-body">
                    <h2 class="mb-1">0</h2>
                    <h5 style="color: blue;"><i class="mdi mdi-star mdi-spin"></i> Blocked Customers</h5>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-sm-6">
            <div class="card card-mini mb-4">
                <div class="card-body">
                    <h2 class="mb-1"> </h2>
                    <h5 style="color: blue;"><i class="mdi mdi-star mdi-spin"></i> All Categories</h5>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-6">
            <div class="card card-mini  mb-4">
                <div class="card-body">
                    <h2 class="mb-1">0</h2>
                    <h5 style="color: blue;"><i class="mdi mdi-star mdi-spin"></i> All Products</h5>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="media widget-media p-4 bg-white border">
                <div class="icon rounded-circle mr-4 bg-success">
                    <i class="mdi mdi-timer-sand mdi-spin text-white "></i>
                </div>
                <div class="media-body align-self-center">
                    <h4 class="text-primary mb-2"><a
                            href="#">0</a>
                    </h4>
                    <p style="color: black;"><a href="#">All Orders</a></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6 col-xl-3">
            <div class="media widget-media p-4 bg-white border">
                <div class="icon rounded-circle bg-primary mr-4">
                    <i class="mdi mdi-timer-sand mdi-spin text-white "></i>
                </div>
                <div class="media-body align-self-center">
                    <h4 class="text-primary mb-2"><a
                            href="#">0</a>
                    </h4>
                    <p style="color: black;"><a href="#">Completed Orders</a></p>
                </div>
            </div>
        </div>
    </div>





    {{-- =========================================================== --}}
    {{-- ================= Pending delivery orders ================= --}}
    {{-- =========================================================== --}}
    <div class="row">
        <div class="col-12">
            <div class="card card-table-border-none" id="recent-orders">
                <div class="card-header justify-content-between " style="background-color: #4c84ff;">
                    <h2 style="color:white;"><i class="mdi mdi-star mdi-spin"></i> Pending orders :</h2>
                </div>
                <div class="card-body pt-0 pb-5">
                    <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-dark font-weight-mediu">#</th>
                                <th class="text-dark font-weight-mediu"> Date/Time</th>
                                <th class="text-dark font-weight-mediu"> Status</th>
                                <th class="text-dark font-weight-mediu"> Sub Total</th>
                                <th class="text-dark font-weight-mediu"> Total</th>
                                <th class="text-dark font-weight-mediu"><i class="mdi mdi-settings mdi-spin"></i> Control
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                                <td colspan="8">
                                    <h3 style="color: red; text-align:center;">There are no new pending delivery orders !!
                                    </h3>
                                </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
