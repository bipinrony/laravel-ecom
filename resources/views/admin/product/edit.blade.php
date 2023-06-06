@extends('layouts.admin.app')
@section('title', $title)

@push('styles')
    <link href="{{ url('admin/assets/libs/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endpush
@section('content')

    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Form Basic</h4>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Library</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <form class="form-horizontal" action="{{ route('admin.product.update') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="card-body">
                                <h4 class="card-title">{{ $title }}</h4>
                                <div class="form-group row">
                                    <label for="name"
                                        class="col-sm-3 text-right control-label col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Name Here" value="{{ $product->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name"
                                        class="col-sm-3 text-right control-label col-form-label">Category</label>
                                    <div class="col-sm-9">
                                        <select name="category_id[]" id="category_id" class="form-control" multiple>
                                            <option value="">Select</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ in_array($category->id, $selected_categories) ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name"
                                        class="col-sm-3 text-right control-label col-form-label">Sub Category</label>
                                    <div class="col-sm-9">
                                        <select name="sub_category_id[]" id="sub_category_id" class="form-control" multiple>
                                            <option value="">Select</option>
                                            @foreach ($subcategories as $subcategory)
                                                <option value="{{ $subcategory->id }}" {{ in_array($subcategory->id, $selected_sub_categories) ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="file"
                                            class="col-sm-3 text-right control-label col-form-label">Feature Image</label>
                                        <div class="col-sm-9">
                                            <input  type="file" class="form-control" name="feature_image" placeholder="address">
                                            <img src="{{ Storage::url($product->feature_image)}}" alt="" height="75px" class="ps-2">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="file"
                                            class="col-sm-3 text-right control-label col-form-label">Image</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" name="images[]" placeholder="address" multiple>
                                            @foreach($product->productImage as $productimg)
                                                <img src="{{ Storage::url($productimg->product_image) }}" alt=""
                                            height="75">
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="price"
                                            class="col-sm-3 text-right control-label col-form-label">Price</label>
                                        <div class="col-sm-9">
                                            <input name="price" id="description" class="form-control" cols="30" rows="10" value="{{ $product->price }}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sale_price"
                                            class="col-sm-3 text-right control-label col-form-label">Sale Price</label>
                                        <div class="col-sm-9">
                                            <input name="sale_price" id="description" class="form-control" cols="30" rows="10" value="{{ $product->sale_price }}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="qty_available"
                                            class="col-sm-3 text-right control-label col-form-label">QTY</label>
                                        <div class="col-sm-9">
                                            <input name="qty_available" id="description" class="form-control" cols="30" rows="10" value="{{ $product->qty_available }}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="short_description"
                                            class="col-sm-3 text-right control-label col-form-label">Short Description</label>
                                        <div class="col-sm-9">
                                            <textarea name="short_description" id="description" class="form-control" cols="30" rows="10">{{ $product->short_description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description"
                                            class="col-sm-3 text-right control-label col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ $product->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="status"
                                            class="col-sm-3 text-right control-label col-form-label">Status</label>
                                        <div class="col-sm-9">
                                            <select name="status" id="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">In active</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>


                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            @include('layouts.admin.footer')
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>

    @endsection

    @push('scripts')
        <script src="{{ url('admin/assets/libs/select2/dist/js/select2.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#category_id').select2();
            });
            $(document).ready(function() {
                $('#sub_category_id').select2();
            });
        </script>
    @endpush
