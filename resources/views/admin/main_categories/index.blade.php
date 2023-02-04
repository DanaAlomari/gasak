@extends('admin.layouts.app')

@section('admin_css')
    {{-- <link href="{{ asset('dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}"
        rel="stylesheet"> --}}
    {{-- <link href="{{ asset('dashboard_files/assets/css/sleek.min.css') }}"> --}}
    {{-- <link href="{{ asset('dashboard_files/assets/css/sleek.css') }}"> --}}

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
                        swal("Oops !!!", "{!! Session::get('danger') !!}", "error", {
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
                    <h1><i class="mdi mdi-account-multiple"></i> All Main Categories</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}"> <i class="mdi  mdi-home"></i> Dashboard </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page"><i class="mdi  mdi-account-multiple"></i> All Main Categories</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('super_admin.mainCategories-create') }}" class="mb-1 btn btn-primary"><i class="mdi mdi-playlist-plus"></i> Add New </a>
                </div>
            </div>

            {{-- ============================================== --}}
            {{-- =================== Body ===================== --}}
            {{-- ============================================== --}}
            <div class="card card-default">
                <div class="card-header justify-content-between " style="background-color: #4c84ff;">
                    {{-- <h2 style="color:white;"><i class="mdi mdi-star mdi-spin"></i> طلبات سحب الرصيد : </h2> --}}
                </div>
                <div class="card-body">
                    <table id="hoverable-data-table" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><i class="mdi mdi-account"></i> Name EN</th>
                                <th><i class="mdi mdi-email"></i> Desc EN</th>
                                <th><i class="mdi mdi-image"></i> Image</th>
                                <th><i class="mdi mdi-account-switch"></i> Status</th>
                                <th><i class="mdi mdi-settings mdi-spin"></i> Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Super Admin --}}
                            @if (isset($mainCategories))
                                @if ($mainCategories->count() > 0)
                                    @foreach ($mainCategories as $index => $category)
                                        <tr>
                                            <td>{!! isset($category->id) ? $category->id : "<span style='color:red;'>Undefined</span>" !!}</td>
                                            <td>{!! isset($category->name_en) ? $category->name_en : "<span style='color:red;'>Undefined</span>" !!}</td>
                                            <td>{!! isset($category->description_en) ? $category->description_en : "<span style='color:red;'>Undefined</span>" !!}</td>
                                            <td>
                                                @if (isset($category->image) && $category->image && file_exists($category->image))
                                                    <img src="{{ asset($category->image) }}" width="70" height="70" style="border-radius: 10px; border:solid 1px black;">
                                                @else
                                                    <img src="{{ asset('front_end_style/images/default.png') }}" width="70" height="50">
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($category->status))
                                                    @if ($category->status == 1)
                                                        <span style="color: green;">Active</span>
                                                    @else
                                                        <span style="color: red;">Not Active</span>
                                                    @endif
                                                @else
                                                    <span style='color:red;'>Undefined</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('super_admin.mainCategories-edit', [$category->id]) }}" title="Edit" class="mb-1 btn btn-sm btn-primary"><i class="mdi mdi-playlist-edit"></i></a>
                                                <a href="{{ route('super_admin.mainCategories-activeInactiveSingle', [$category->id]) }}" title="Active / Inactive" class="process mb-1 btn btn-sm {{ $category->status == 1 ? 'btn-warning' : 'btn-success' }}"><i class="mdi mdi-stop"></i></a>
                                                <a href="{{ route('super_admin.mainCategories-destroy', [$category->id]) }}" title="Archive" class="confirm mb-1 btn btn-sm btn-danger"><i class="mdi mdi-close"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endif
                        </tbody>
                    </table>
                    {!! $mainCategories->links() !!}
                </div>
            </div>

        </div>
    </div>
@endsection

@section('admin_javascript')
    <script>
        jQuery(document).ready(function() {
            jQuery('#hoverable-data-table').DataTable({
                "aLengthMenu": [
                    [20, 30, 50, 75, -1],
                    [20, 30, 50, 75, "All"]
                ],
                "pageLength": false,
                "dom": false
            });
        });
    </script>
    <script src="{{ asset('dashboard_files/assets/plugins/data-tables/jquery.datatables.min.js') }}">
    </script>
    <script src="{{ asset('dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.js') }}">
    </script>

@endsection
