@extends('admin.layouts.app')

@section('admin_css')
    <link href="{{ asset('dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard_files/assets/css/sleek.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content">
            <div class="breadcrumb-wrapper breadcrumb-contacts">
                {{-- ============================================== --}}
                {{-- ================== Header ==================== --}}
                {{-- ============================================== --}}
                <div>
                    <h1><i class="mdi mdi-playlist-edit"></i> Update Promo Code Information</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <i class="mdi mdi-home"></i> Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.promo_codes-index') }}">
                                    <i class="mdi mdi-account-group"></i> All Promo Codes
                                </a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page"><i class="mdi mdi-playlist-edit"></i> Edit</li>
                        </ol>
                    </nav>
                </div>

                {{-- ============================================== --}}
                {{-- =================== Body ===================== --}}
                {{-- ============================================== --}}
                <div class="content-wrapper">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-default">
                                    <div class="card-header justify-content-between " style="background-color: #4c84ff;">
                                        {{-- <h2 style="color:white;"><i class="mdi mdi-star mdi-spin"></i> طلبات سحب الرصيد : </h2> --}}
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('super_admin.promo_codes-update', [$promoCode->id]) }}" method="POST"
                                            id="updateForm" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">

                                                {{-- Promo Code --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">
                                                        <i class="mdi mdi-account"></i> Promo Code : <strong
                                                            class="text-danger"> * @error('promo_code') (
                                                            {{ $message }} ) @enderror</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account" id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="text" name="promo_code" class="form-control @error('promo_code') is-invalid @enderror"
                                                            id="validationServer01" placeholder="Promo Code"
                                                            value="{{ $promoCode->promo_code }}">
                                                    </div>
                                                </div>

                                                {{-- Promo Type --}}
                                                {{-- <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">
                                                        <i class="mdi mdi-account-switch"></i> Promo Type : <strong class="text-danger"> * @error('promo_type') ( {{ $message }} ) @enderror</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account-check"></span>
                                                        </div>
                                                        <select name="promo_type" class="custom-select my-1 mr-sm-2 @error('promo_type') is-invalid @enderror">
                                                            <option value="">Select Promo Type...</option>
                                                            <option value="1" @if ($promoCode->promo_type == 'Percentage') selected @endif>Percentage</option>
                                                            <option value="2" @if ($promoCode->promo_type == 'Amount') selected @endif>Amount</option>
                                                        </select>
                                                    </div>
                                                </div> --}}

                                                {{-- Promo Value --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                                        <i class="mdi mdi-account"></i> Promo Value : <strong class="text-danger"> * @error('promo_value') ( {{ $message }} ) @enderror</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account" id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="number" step="0.01" name="promo_value" class="form-control @error('promo_value') is-invalid @enderror"
                                                            id="validationServer01" placeholder="Promo Code" value="{{ $promoCode->promo_value }}">
                                                    </div>
                                                </div>

                                                {{-- Expiration Date --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3" for="validationServer01">
                                                        <i class="mdi mdi-account"></i> Expiration Date : <strong class="text-danger"> * @error('expiration_date') ( {{ $message }} ) @enderror</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account" id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="date" name="expiration_date"
                                                            class="form-control @error('expiration_date') is-invalid @enderror"
                                                            id="validationServer01" placeholder="Expiration Date"
                                                            value="{{ $promoCode->expiration_date }}">
                                                    </div>
                                                </div>

                                                {{-- Status --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">
                                                        <i class="mdi mdi-account-switch"></i> Status : <strong class="text-danger"> * @error('status') ( {{ $message }} ) @enderror</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account-check"></span>
                                                        </div>
                                                        <select name="status" class="custom-select my-1 mr-sm-2 @error('status') is-invalid @enderror" id="inlineFormCustomSelectPref">
                                                            <option value="">Select Status...</option>
                                                            <option value="1" @if (isset($promoCode->status) && $promoCode->status == 'Active') selected @endif>Active</option>
                                                            <option value="2" @if (isset($promoCode->status) && $promoCode->status == 'Inactive') selected @endif>Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                            {{-- Button --}}
                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-content-save-all"></i> Save Updates</button>
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
    @section('admin_javascript')

    @endsection
