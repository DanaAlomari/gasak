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
                    <h1><i class="mdi mdi-playlist-edit"></i> Update Product Information</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.dashboard') }}">
                                    <i class="mdi mdi-home"></i> Dashboard
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('super_admin.products-index') }}">
                                    <i class="mdi mdi-account-group"></i> All Product
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
                                        <form action="{{ route('super_admin.products-update', [$product->id]) }}"
                                            method="POST" id="updateForm" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row">
                                                {{-- Name EN --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">
                                                        <i class="mdi mdi-account"></i> Name : <strong
                                                            class="text-danger"> * @error('name_en') (
                                                            {{ $message }} ) @enderror</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account"
                                                                id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="text" name="name_en"
                                                            class="form-control @error('name_en') is-invalid @enderror"
                                                            id="validationServer01" placeholder="Name EN"
                                                            value="{{ isset($product->name_en) ? $product->name_en : null }}">
                                                    </div>
                                                </div>

                                                {{-- Super Category --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">
                                                        <i class="mdi mdi-account-switch"></i>  Category : <strong
                                                            class="text-danger"> * @error('category_id') (
                                                            {{ $message }} ) @enderror</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account-check"></span>
                                                        </div>
                                                        <select name="category_id" id="category_id"
                                                        class="form-control selectpicker" data-live-search="true"
                                                            id="inlineFormCustomSelectPref">
                                                            <option value="">Select Category...</option>
                                                            @if (isset($categories))
                                                                @foreach ($categories as $category)
                                                                    <option data-icon="fa fa-sitemap"
                                                                        value="{{ $category->id }}"
                                                                        @if ($product->category_id == $category->id) selected @endif>
                                                                        {{ $category->name_en }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                                {{-- weight --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">
                                                        <i class="mdi mdi-account"></i> Weight : <strong class="text-danger">  @error('weight') ( {{ $message }} ) @enderror</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account" id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="number" name="weight" step="0.001" class="form-control @error('weight') is-invalid @enderror" id="validationServer01"
                                                        placeholder="Sale Price" value="{{ $product->weight}}">
                                                    </div>
                                                </div>
                                                {{-- Sale Price --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">
                                                        <i class="mdi mdi-account"></i> Sale Price : <strong
                                                            class="text-danger"> * @error('sale_price') (
                                                            {{ $message }} ) @enderror</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account"
                                                                id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="number" name="sale_price" step="0.001"
                                                            class="form-control @error('sale_price') is-invalid @enderror"
                                                            id="validationServer01" placeholder="Sale Price"
                                                            value="{{ isset($product->sale_price) ? $product->sale_price : null }}">
                                                    </div>
                                                </div>
                                                {{-- Available Quantity --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">
                                                        <i class="mdi mdi-account"></i> Limit Quantity : <strong
                                                            class="text-danger"> * @error('quantity_limit') (
                                                            {{ $message }} ) @enderror</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account"
                                                                id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <input type="number" name="quantity_limit" step="1"
                                                            class="form-control @error('quantity_limit') is-invalid @enderror"
                                                            id="validationServer01" placeholder="Available Quantity"
                                                            value="{{ $product->quantity_limit }}">
                                                    </div>
                                                </div>
                                                {{-- Main Description EN --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">
                                                        Main Description : <strong class="text-danger"> *
                                                            @error('main_description_en') - {{ $message }}
                                                            @enderror</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-book-open"
                                                                id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <textarea style="width: 90% !important" name="main_description_en"
                                                            class="form-control"
                                                            rows="5">{{ isset($product->main_description_en) ? $product->main_description_en : null }}</textarea>
                                                    </div>
                                                </div>
                                                {{-- Sub Description EN --}}
                                                <div class="col-12">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">
                                                        Sub Description : <strong class="text-danger"> *
                                                            @error('sub_description_en') - {{ $message }}
                                                            @enderror</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-book-open"
                                                                id="inputGroupPrepend2"></span>
                                                        </div>
                                                        <textarea style="width: 90% !important" name="sub_description_en"
                                                            class="form-control"
                                                            rows="5">{{ isset($product->sub_description_en) ? $product->sub_description_en : null }}</textarea>
                                                    </div>
                                                </div>
                                                {{-- Status --}}
                                                <div class="col-md-12 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">
                                                        <i class="mdi mdi-account-switch"></i> Status : <strong
                                                            class="text-danger"> * @error('status') (
                                                            {{ $message }} ) @enderror</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-account-check"></span>
                                                        </div>
                                                        <select name="status"
                                                            class="custom-select my-1 mr-sm-2 @error('status') is-invalid @enderror"
                                                            id="inlineFormCustomSelectPref">
                                                            <option value="">Select Status...</option>
                                                            <option value="1" @if (isset($product->status) && $product->status == 1) selected @endif>Active</option>
                                                            <option value="2" @if (isset($product->status) && $product->status == 2) selected @endif>Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- Image Filed --}}
                                                <div class="col-md-6 mb-3">
                                                    <label class="text-dark font-weight-medium mb-3"
                                                        for="validationServer01">
                                                        <i class="mdi mdi-image"></i> Image : <strong
                                                            class="text-danger"> @error('image')* ( {{ $message }}
                                                            ) @enderror</strong>
                                                    </label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text mdi mdi-image"></span>
                                                        </div>
                                                        <input type="file" name="image" class="form-control"
                                                            id="validationServer01" placeholder="Image">
                                                    </div>
                                                </div>
                                                {{-- Display Image --}}
                                                <div class="col-md-12 mb-3">
                                                        @if ($product->image && file_exists($product->image))
                                                            <img src="{{ asset($product->image) }}" width="100"
                                                                height="100"
                                                                style="border-radius: 10px; border:solid 1px black;">
                                                        @else
                                                            <img src="{{ asset('front_end_style/images/default.png') }}"
                                                                width="100" height="100">
                                                        @endif
                                                </div>

                                            </div>

                                            {{-- Button --}}
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="mdi mdi-content-save-all"></i> Save Updates</button>
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
