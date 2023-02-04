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
                    <h1><i class="mdi mdi-account-multiple"></i> All Products</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}"> <i class="mdi  mdi-home"></i> Dashboard </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page"><i class="mdi  mdi-account-multiple"></i> All
                                Products</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('super_admin.products-create') }}" class="mb-1 btn btn-primary"><i
                            class="mdi mdi-playlist-plus"></i> Add New </a>
                </div>
            </div>

            {{-- ============================================== --}}
            {{-- =================== Body ===================== --}}
            {{-- ============================================== --}}
            <div class="card card-default">
                <div class="card-header justify-content-between " style="background-color: #4c84ff;">
                </div>
                <div class="card-body">
                    <table id="hoverable-data-table" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><i class="mdi mdi-account"></i> Name EN</th>
                                <th><i class="mdi mdi-email"></i> Sale Price</th>
                                <th><i class="mdi mdi-image"></i> Image</th>
                                <th><i class="mdi mdi-account-switch"></i> Status</th>
                                <th><i class="mdi mdi-account"></i>Category</th>
                                <th><i class="mdi mdi-settings mdi-spin"></i> Control</th>
                            </tr>
                        </thead>
                        <tbody id="products_tbody">
                            @if (isset($products))
                                @if ($products->count() > 0)
                                    @foreach ($products as $index => $product)
                                        <tr>
                                            <td>{!! isset($product->id) ? $product->id : "<span style='color:red;'>Undefined</span>" !!}</td>
                                            <td>{!! isset($product->name_en) ? $product->name_en : "<span style='color:red;'>Undefined</span>" !!}</td>
                                            <td>{!! isset($product->sale_price) ? $product->sale_price : "<span style='color:red;'>Undefined</span>" !!}</td>
                                            <td>
                                                @if (isset($product->image) && $product->image && file_exists($product->image))
                                                    <img src="{{ asset($product->image) }}" width="70" height="70"
                                                        style="border-radius: 10px; border:solid 1px black;">
                                                @else
                                                    <img src="{{ asset('front_end_style/images/default.png') }}"
                                                        width="70" height="50">
                                                @endif
                                            </td>
                                            <td>
                                                @if (isset($product->status))
                                                    @if ($product->status == 1)
                                                        <span style="color: green;">Active</span>
                                                    @else
                                                        <span style="color: red;">Not Active</span>
                                                    @endif
                                                @else
                                                    <span style='color:red;'>Undefined</span>
                                                @endif
                                            </td>
                                            <td>{!! isset($product->category->name_en)
                                                        ? $product->category->name_en
                                                        : "<span style='color:red;'>Undefined</span>" !!}
                                            </td>
                                            <td>
                                                <a href="{{ route('super_admin.products-edit', [$product->id]) }}"
                                                    title="Edit" class="mb-1 btn btn-sm btn-primary"><i
                                                        class="mdi mdi-playlist-edit"></i></a>
                                                <a href="{{ route('super_admin.products-activeInactiveSingle', [$product->id]) }}"
                                                    title="Active / Inactive" class="process mb-1 btn btn-sm btn-warning"><i
                                                        class="mdi mdi-stop"></i></a>
                                                <a href="{{ route('super_admin.products-destroy', [$product->id]) }}"
                                                    title="Archive" class="confirm mb-1 btn btn-sm btn-danger"><i
                                                        class="mdi mdi-close"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endif
                        </tbody>

                    </table>
                    {!! $products->links() !!}

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
