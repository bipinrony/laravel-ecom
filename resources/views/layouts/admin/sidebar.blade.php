<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.html"
                        aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                            class="hide-menu">Dashboard</span></a>
                </li>

                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                        href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span
                            class="hide-menu">Category </span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item">
                            <a href="{{ route('admin.categories') }}" class="sidebar-link">
                                <i class="mdi mdi-note-outline"></i><span class="hide-menu"> Categories
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('admin.sub_categories') }}" class="sidebar-link">
                                <i class="mdi mdi-note-plus"></i><span class="hide-menu"> Sub Categories
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark"
                    href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span
                        class="hide-menu">Product</span></a>
                <ul aria-expanded="false" class="collapse  first-level">
                    <li class="sidebar-item">
                        <a href="{{ route('admin.products') }}" class="sidebar-link">
                            <i class="mdi mdi-note-outline"></i><span class="hide-menu">All Products
                            </span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('admin.product.get') }}" class="sidebar-link">
                            <i class="mdi mdi-note-plus"></i><span class="hide-menu"> Add Product
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.sliders') }}" class="sidebar-link">
                    <i class="mdi mdi-note-plus"></i><span class="hide-menu">Slider
                    </span>
                </a>
            </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
