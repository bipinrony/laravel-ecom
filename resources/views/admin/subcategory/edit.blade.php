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


                        <form class="form-horizontal" action="{{ route('admin.subcategories.update') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $sub_category->id }}">
                            <div class="card-body">
                                <h4 class="card-title">{{ $title }}</h4>
                                <div class="form-group row">
                                    <label for="name"
                                        class="col-sm-3 text-right control-label col-form-label">Categories</label>
                                    <div class="col-sm-9">
                                        <select name="category_id[]" id="category_id" class="form-control" multiple>
                                            <option value="">Select</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ in_array($category->id, $selected_categories) ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach

                                            {{-- @foreach ($categories as $category)
                                                @php
                                                    $selected = '';
                                                @endphp
                                                @foreach ($selected_categories as $selected_category)
                                                    @if ($selected_category->category_id == $category->id)
                                                        @php
                                                            $selected = 'selected';
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <option value="{{ $category->id }}" {{ $selected }}>
                                                    {{ $category->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body">

                                    <div class="form-group row">
                                        <label for="name"
                                            class="col-sm-3 text-right control-label col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Name Here" value="{{ $sub_category->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="file"
                                            class="col-sm-3 text-right control-label col-form-label">Image</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="image" class="form-control" id="file">
                                            <img src="{{ Storage::url($sub_category->image) }}" alt=""
                                                height="75">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description"
                                            class="col-sm-3 text-right control-label col-form-label">Description</label>
                                        <div class="col-sm-9">
                                            <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{ $sub_category->description }}</textarea>
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
        </script>
    @endpush
