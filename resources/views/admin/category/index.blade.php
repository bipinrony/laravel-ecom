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
                    <a href="{{ route('admin.categories.get') }}" class="btn btn-primary"><i class="fa fa-plus"></i>Add
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

                            {{-- <div style="display: flex; justify-content: space-between;">
                                <h5 class="card-title">{{ $title }}</h5>
                                <form action=""><input type="text" name="search" placeholder="search"></form>
                            </div> --}}

                            <h5 class="card-title">{{ $title }}</h5>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Description</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>{{ $category->description }}</td>
                                                <td><img src="{{ Storage::url($category->image) }}" alt=""
                                                        height="75">
                                                </td>
                                                <td>{{ $category->status == 1 ? 'Active' : 'Inactive' }}</td>
                                                <td>
                                                    <a href="{{ route('admin.categories.edit', [$category->id]) }}"><i
                                                            class="fa fa-pencil"></i> Edit</a>
                                                    <a href="{{ route('admin.categories.delete', [$category->id]) }}"><i
                                                            class="fa fa-trash"></i> Delete</a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody> --}}
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
        $(function() {
            var table = $('#zero_config').DataTable({
                processing: true,
                serverSide: true,
                displayLength: 1,
                ajax: "{{ route('admin.categoryList') }}",
                columnDefs: [{
                        targets: 0,
                        data: 'name',
                        name: 'name'
                    },
                    {
                        targets: 1,
                        data: 'slug',
                        name: 'slug'
                    },
                    {
                        targets: 2,
                        data: 'description',
                        name: 'description'
                    },
                    {
                        targets: 3,
                        data: 'product_image',
                        name: 'product_image'
                    },
                    {
                        targets: 4,
                        data: 'status',
                        name: 'status'
                    },
                    {
                        targets: 5,
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: true
                    },
                ],
            });
        });
    </script>
@endpush
