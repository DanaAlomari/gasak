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
                        <form action="{{ route('super_admin.login.submit') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12" style="bottom: 25px">
                                    <label>E-mail / Username</label>
                                    <input class="form-control" name="email" type="text" placeholder="E-mail">
                                </div>
                                <div class="col-md-12" style="bottom: 13px">
                                    <label>Password</label>
                                    <input class="form-control" name="password" type="password" placeholder="Password">
                                </div>
                                <div class="col-md-12" style="bottom: 5px">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="newaccount">
                                        <label class="custom-control-label" for="newaccount">Keep me signed in</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-lg btn-primary">Submit</button>
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
