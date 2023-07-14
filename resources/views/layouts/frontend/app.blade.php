<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="{{ url('front/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ url('front/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ url('front/css/style.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    @include('layouts.frontend.header')
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                    data-toggle="collapse" href="#navbar-vertical"
                    style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 {{ request()->routeIs('home') ? 'show' : '' }}"
                    id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        {{-- @php
                            $categories = App\Models\Category::where('status', 1)->get();
                        @endphp --}}
                        @foreach ($header_categories as $category)
                            @if ($category->subCategories->count())
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link" data-toggle="dropdown">{{ $category->name }} <i
                                            class="fa fa-angle-down float-right mt-1"></i></a>
                                    <div
                                        class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                        @foreach ($category->subCategories as $subCategory)
                                            <a href="{{ route('shop', [$category->slug, $subCategory->subCategory->slug]) }}"
                                                class="dropdown-item">{{ $subCategory->subCategory->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <a href="{{ route('shop', [$category->slug]) }}"
                                    class="nav-item nav-link">{{ $category->name }}</a>
                            @endif
                        @endforeach

                        {{-- @foreach ($categories as $category)
                            @if ($category->sub_categories->count())
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link" data-toggle="dropdown">{{ $category->name }} <i
                                            class="fa fa-angle-down float-right mt-1"></i></a>
                                    <div
                                        class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                        @foreach ($category->sub_categories as $subCategory)
                                            <a href="{{ route('shop', [$category->slug, $subCategory->slug]) }}"
                                                class="dropdown-item">{{ $subCategory->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <a href="{{ route('shop', $category->slug) }}"
                                    class="nav-item nav-link">{{ $category->name }}</a>
                            @endif
                        @endforeach --}}
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span
                                class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>
                            <a href="{{ route('shop') }}" class="nav-item nav-link">Shop</a>
                            <a href="detail.html" class="nav-item nav-link">Shop Detail</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                                    <a href="checkout.html" class="dropdown-item">Checkout</a>
                                </div>
                            </div>
                            <a href="{{route('contact-form.index')}}" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                            @if (Auth::check())
                                <a href="#" class="nav-item nav-link">Welcome {{ Auth::user()->name }}</a>
                                <a href="{{ route('logout') }}" class="nav-item nav-link">Logout</a>
                            @else
                                <a href="{{ route('login.get') }}" class="nav-item nav-link">Login</a>
                                <a href="{{ route('register.get') }}" class="nav-item nav-link">Register</a>
                            @endif

                        </div>
                    </div>
                </nav>

                @yield('header-carousel')

            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Featured Start -->
    @yield('content')
    <!-- Vendor End -->


    <!-- Footer Start -->
    @include('layouts.frontend.footer')
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('front/lib/easing/easing.min.js') }}"></script>
    <script src="{{ url('front/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ url('front/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ url('front/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ url('front/js/main.js') }}"></script>
    <script>
        function switchLanguage(locale) {
            var url = "{{ url('/switch-language') }}" + '/' + locale;
            window.location.href = url;
        }

        function getCartCount() {
            $.ajax({
                url: "{{ route('cartCount') }}",
                success: function(res) {
                    $('#cart-count').text(res.cart_total);
                }
            });
        }
    </script>

    @stack('script')
</body>

</html>
