@extends('layouts.frontend.app');
@section('title', $title);
@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shopping Cart</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cart->cartItems as $cartItem)
                            <tr>
                                <td class="align-middle"><img src="{{ Storage::url($cartItem->product->feature_image) }}"
                                        alt="" style="width: 50px;">
                                    {{ $cartItem->product->name }}</td>
                                <td class="align-middle">${{ $cartItem->price }}</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary text-center cart-qty"
                                            value="{{ $cartItem->quantity }}" data-id="{{ $cartItem->id }}"
                                            data-url="{{ route('update-quantity', [$cartItem->id]) }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle">${{ $cartItem->quantity * $cartItem->price }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('remove-from-cart', [$cartItem->id]) }}"
                                        class="btn btn-sm btn-primary"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">${{ $cart->sub_total }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">${{ $cart->shipping }}</h6>
                        </div>

                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Tax</h6>
                            <h6 class="font-weight-medium">${{ $cart->tax }}</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">${{ $cart->total }}</h5>
                        </div>
                        <button class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('.cart-qty').on('change', function() {
                // var cartItem = $(this).data('id');
                // var url = "{{ route('update-quantity', ['cartItem']) }}";
                // url = url.replace('cartItem', cartItem);

                var qty = $(this).val();
                var url = $(this).data('url');
                updateQty(qty, url);
            });

            $('.input-group-btn').on('click', function() {
                var qty = $(this).parent().find('.cart-qty').val();
                var url = $(this).parent().find('.cart-qty').data('url');
                updateQty(qty, url);
            });

        });

        function updateQty(qty, url) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    quantity: qty
                },
                success: function(res) {
                    console.log(res);
                    window.location.reload();
                }
            });
        }
    </script>
@endpush
