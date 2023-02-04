@extends('admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content">
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
                        swal("oops !!!", "{!! Session::get('danger') !!}", "error", {
                            button: "Close",
                        });

                    </script>
                @endif
            </div>

            {{-- ============================================== --}}
            {{-- ================== Header ==================== --}}
            {{-- ============================================== --}}
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div>
                    <h1>About Us</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">About Us</li>
                        </ol>
                    </nav>
                </div>
                <div>

                    <a href="{{ route('super_admin.about_us-edit', $about->id) }}" class="mb-1 btn btn-primary"><i
                            class="mdi mdi-playlist-edit"></i> Edit </a>
                </div>
            </div>

            {{-- ============================================== --}}
            {{-- =================== Body ===================== --}}
            {{-- ============================================== --}}
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                <div class="content-wrapper">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-default">
                                    <div class="card-header card-header-border-bottom">
                                        <h2>About Us</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-flex justify-content-center ">
                                                    <div class="text-center pb-4">
                                                        <h3 class="text-dark pb-2">About Us </h3>
                                                        <p class="text-dark">
                                                            {!! isset($about->about_us_en) ? $about->about_us_en : "<span style='color:red;'>Undefined</span>" !!}
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr class="w-100">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="d-flex justify-content-center ">
                                                    <div class="text-center pb-4">
                                                        <h3 class="text-dark pb-2">Vision </h3>
                                                        <p class="text-dark">
                                                            {!! isset($about->vision_en) ? $about->vision_en : "<span style='color:red;'>Undefined</span>" !!}

                                                        </p>
                                                    </div>
                                                </div>
                                                <hr class="w-100">
                                            </div>

                                            <div class="col-md-6">
                                                <div class="d-flex justify-content-center ">
                                                    <div class="text-center pb-4">
                                                        <h3 class="text-dark pb-2">Mission </h3>
                                                        <p class="text-dark">
                                                            {!! isset($about->mission_en) ? $about->mission_en : "<span style='color:red;'>Undefined</span>" !!}

                                                        </p>
                                                    </div>
                                                </div>
                                                <hr class="w-100">
                                            </div>
                                            <div class="col-md-4 m-auto">
                                                <div class="card card-mini mb-4">
                                                    @if ($about->about_us_image && file_exists($about->about_us_image))
                                                        <img style="height: 150px"
                                                            src="{{ asset($about->about_us_image) }}" width="auto">
                                                    @else
                                                        <img style="height: 150px"
                                                            src="{{ asset('images_default/default.jpg') }}" width="auto">
                                                    @endif
                                                    <span class="rounded p-1 text-light bg-danger  text-center">About Us Image</span>
                                                </div>
                                            </div>

                                            <div class="col-md-4 m-auto">
                                                <div class="card card-mini mb-4">
                                                    @if ($about->mission_image && file_exists($about->mission_image))
                                                        <img style="height: 150px"
                                                            src="{{ asset($about->mission_image) }}" width="auto">
                                                    @else
                                                        <img style="height: 150px"
                                                            src="{{ asset('images_default/default.jpg') }}" width="auto">
                                                    @endif
                                                    <span class="rounded p-1 text-light bg-danger  text-center">Mission Image</span>
                                                </div>
                                            </div>


                                            <div class="col-md-4 m-auto">
                                                <div class="card card-mini mb-4">
                                                    @if ($about->vision_image && file_exists($about->vision_image))
                                                        <img style="height: 150px" src="{{ asset($about->vision_image) }}"
                                                            width="auto">
                                                    @else
                                                        <img style="height: 150px"
                                                            src="{{ asset('images_default/default.jpg') }}" width="auto">
                                                    @endif
                                                    <span class="rounded p-1 text-light bg-danger  text-center">Vision Image</span>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
