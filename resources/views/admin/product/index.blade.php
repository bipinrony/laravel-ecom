@extends('layouts.admin.app')
@section('title', $title)
@section('content')

    <link href="{{ url('admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">

    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Tables</h4>
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
                <div class="col-12 text-right mb-2">
                    <a href="{{ route('admin.product.get') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Add
                        new</a>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            @if (Session::has('success'))
                                <div class="alert alert-primary">
                                    <strong>{{ Session::get('success') }}</strong>
                                </div>
                            @endif

                            @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    <strong>{{ Session::get('error') }}</strong>
                                </div>
                            @endif

                            <h5 class="card-title">{{ $title }}</h5>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->slug }}</td>
                                                <td>
                                                    @forelse ($product->categories as $category)
                                                        {{ $category->category->name }},
                                                    @empty
                                                        --
                                                    @endforelse
                                                </td>
                                                <td>
                                                    @forelse ($product->subCategory as $subcategory)
                                                        {{ $subcategory->subCategory->name }},
                                                    @empty
                                                        --
                                                    @endforelse
                                                </td>
                                            
                                                <td>{{ $product->short_description }}</td>
                                                <td>
                                                    <img src="{{ Storage::url($product->feature_image) }}" alt=""
                                                    height="75">
                                                    {{-- <img src="{{ Storage::url($product->productImage->product_image) }}" alt=""
                                                        height="75"> --}}
                                                </td>
                                                <td>{{ $product->status == 1 ? 'Active' : 'Inactive' }}</td>
                                                <td>
                                                    <a href="{{ route('admin.product.edit', [$product->id]) }}"><i
                                                            class="fa fa-pencil"></i> Edit</a>
                                                    <a href="{{ route('admin.product.delete', [$product->id]) }}"><i
                                                            class="fa fa-trash"></i> Delete</a>
                                                    {{-- <form action="{{ route('admin.categories.delete') }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                                        <input type="submit" value="delete">
                                                    </form> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>

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
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
@endsection

@push('scripts')
    <script src="{{ url('admin/assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
    <script src="{{ url('admin/assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
    <script src="{{ url('admin/assets/extra-libs/DataTables/datatables.min.js') }}"></script>

    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>
@endpush
