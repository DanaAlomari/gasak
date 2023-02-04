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
                    <h1><i class="mdi mdi-account-multiple"></i> All Users</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}"> <i class="mdi  mdi-home"></i> Dashboard </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page"><i class="mdi  mdi-account-multiple"></i> All Users</li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href="{{ route('super_admin.users-create') }}" class="mb-1 btn btn-primary"><i class="mdi mdi-playlist-plus"></i> Add New </a>
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
                                {{-- <th>#</th> --}}
                                <th><i class="mdi mdi-account"></i> Name EN</th>
                                <th><i class="mdi mdi-email"></i> Email</th>
                                <th><i class="mdi mdi-phone"></i> Phone</th>
                                <th><i class="mdi mdi-account-question"></i> User Type</th>
                                <th><i class="mdi mdi-account-switch"></i> User Status</th>
                                {{-- <th><i class="mdi mdi-image"></i> صورة</th> --}}
                                <th><i class="mdi mdi-settings mdi-spin"></i> Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Super Admin --}}
                            @if (isset($users))
                                @if ($users->count() > 0)
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            {{-- <td>{!! isset($user->id) ? $user->id : "<span style='color:red;'>Undefined</span>" !!}</td> --}}
                                            <td>{!! isset($user->name_en) ? $user->name_en : "<span style='color:red;'>Undefined</span>" !!}</td>
                                            <td>{!! isset($user->email) ? $user->email : "<span style='color:red;'>Undefined</span>" !!}</td>
                                            <td>{!! isset($user->phone) ? $user->phone : "<span style='color:red;'>Undefined</span>" !!}</td>
                                            <td>{{ $user->user_type == 1 ? 'Super Admin' : 'Customer' }}</td>
                                            <td>
                                                <span style="color: green;">{{ $user->user_status == 1 ? 'Active' : 'InActive' }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('super_admin.users-show',$user->id) }}"
                                                    title="Show" class="mb-1 btn btn-sm btn-info"><i
                                                        class="mdi mdi-eye"></i></a>
                                                <a href="{{ route('super_admin.users-edit',$user->id) }}"
                                                    title="Edit" class="mb-1 btn btn-sm btn-primary"><i
                                                        class="mdi mdi-playlist-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endif

                        </tbody>
                    </table>
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
                "pageLength": 20,
                "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">'
            });
        });
    </script>
    <script src="{{ asset('dashboard_files/assets/plugins/data-tables/jquery.datatables.min.js') }}">
    </script>
    <script src="{{ asset('dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.js') }}">
    </script>

@endsection
