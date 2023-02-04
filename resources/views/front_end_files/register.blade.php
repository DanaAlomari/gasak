@extends('front_end_layouts.app_layout')

@section('content')

    {{-- =========================================================== --}}
    {{-- ================== Sweet Alert Section ==================== --}}
    {{-- =========================================================== --}}
    <div id="alert_div">
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

    <!-- Breadcrumb End -->

    <!-- Login Start -->
    <div class="login" style="padding: 10%;background-color: #343a40;color: blanchedalmond;">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-8">
                    <div class="login-form">
                        <form action="{{ route('customers.register_customer.submit') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12" style="bottom: 25px">
                                    <label>Name </label>
                                    <input class="form-control" name="name" type="text" placeholder="Name" required>
                                </div>
                                <div class="col-md-12" style="bottom: 25px">
                                    <label>E-mail</label>
                                    <input class="form-control" name="email" type="email" placeholder="E-mail" required>
                                </div>
                                <div class="col-md-12" style="bottom: 25px">
                                    <label>Phone</label>
                                    <input class="form-control" name="phone" type="text" placeholder="phone" required>
                                </div>
                                <div class="col-md-12" style="bottom: 13px">
                                    <label>Password</label>
                                    <input class="form-control" name="password" type="password" placeholder="Password" required>
                                </div>
                                <div class="col-md-12" style="bottom: 13px">
                                    <label>Confirm Password</label>
                                    <input class="form-control" name="password_confirmation" type="password" placeholder="Password" required>
                                </div>
                                <div class="col-md-12 row">
                                    <div class="col-md-3">
                                        <button class="btn btn-lg btn-primary">Submit</button>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <a class="text-primary" href="{{route('customers.login')}}">Login</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login End -->

    @endsection
