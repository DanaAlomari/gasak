@extends('admin.layouts.app')

@section('admin_css')
    <link href="{{ asset('dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_files/assets/css/sleek.min.css') }}">
@endsection

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
                    <h1>Update About Us</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <span class="mdi mdi-home"></span> dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.about_us-index') }}">
                                    <span class="mdi mdi-account-group"></span> About Us
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>

                <div class="content-wrapper">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-default">
                                    <div class="card-header card-header-border-bottom">
                                        <h2>Update  About Us :</h2>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('super_admin.about_us-update', $about->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col-md-12 mb-3">
                                                    <h3 class="mb-3" for="validationServer01">About Us :</h3>
                                                    <div class="input-group">
                                                        <textarea name="about_us_en" class="form-control" rows="10">{!! isset($about->about_us_en) ? $about->about_us_en : null !!}</textarea>
                                                    </div>
                                                    @error('about_us_en')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>



                                                <div class="col-md-12 mb-3">
                                                    <h3 class="mb-3" for="validationServer01"> Vision :</h3>
                                                    <div class="input-group">

                                                        <textarea name="vision_en" class="form-control"
                                                            rows="10">{!! isset($about->vision_en) ? $about->vision_en : null !!}</textarea>
                                                    </div>
                                                    @error('vision_en')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>



                                                <div class="col-md-12 mb-3">
                                                    <h3 class="mb-3" for="validationServer01"> Mission :</h3>
                                                    <div class="input-group">

                                                        <textarea name="mission_en" class="form-control"
                                                        rows="10">{!! isset($about->mission_en) ? $about->mission_en : null !!}</textarea>

                                                    </div>
                                                    @error('mission_en')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <h3 class="mb-3" for="validationServer01">About Us Image  :</h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="about_us_image" class="form-control"
                                                            id="validationServer01" placeholder="about_us_image">
                                                    </div>


                                                    @if ($about->about_us_image && file_exists($about->about_us_image))
                                                        <img src="{{ asset($about->about_us_image) }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.jpg') }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif


                                                    @error('about_us_image')
                                                    <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                @enderror
                                                </div>



                                                <div class="col-md-4 mb-3">
                                                    <h3 class="mb-3" for="validationServer01">Vision  Image  :</h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="vision_image" class="form-control"
                                                            id="validationServer01" placeholder="vision_image">
                                                    </div>


                                                    @if ($about->vision_image && file_exists($about->vision_image))
                                                        <img src="{{ asset($about->vision_image) }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.jpg') }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif


                                                    @error('vision_image')
                                                    <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                @enderror
                                                </div>


                                                <div class="col-md-4 mb-3">
                                                    <h3 class="mb-3" for="validationServer01">Mission Image :</h3>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-cloud-upload"></span>
                                                        </div>
                                                        <input type="file" name="mission_image" class="form-control"
                                                            id="validationServer01" placeholder="mission_image">
                                                    </div>


                                                    @if ($about->mission_image && file_exists($about->mission_image))
                                                        <img src="{{ asset($about->mission_image) }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @else
                                                        <img src="{{ asset('images_default/default.jpg') }}" width="100"
                                                            height="100"
                                                            style="border-radius: 10px; border:solid 1px black;">
                                                    @endif

                                                    @error('mission_image')
                                                        <h4 class="form-text text-danger"> - {{ $message }}</h4>
                                                    @enderror
                                                </div>






                                            </div>
                                            <button class="btn btn-primary" type="submit">Edit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
