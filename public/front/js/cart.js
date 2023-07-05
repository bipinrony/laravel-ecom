$(document).ready(function () {
    $(".cart-qty").on("change", function () {
        var qty = $(this).val();
        var url = $(this).data("url");
        updateQty(qty, url);
    });

    $(".add-product-cart-btn").on("click", function () {
        element = $(this);
        var url = element.data("href");
        var qty = $("#product-quantity").val();
        url = url.replace("quantity", qty);
        $.ajax({
            url: url,
            success: function (res) {
                if (res.status) {
                    element
                        .parent()
                        .html(
                            `<button class="btn btn-primary px-3"> Added To Cart</button>`
                        );
                    getCartCount();
                }
            },
        });
    });

    $(".add-to-cart-btn").on("click", function () {
        element = $(this);
        $.ajax({
            url: element.data("href"),
            success: function (res) {
                if (res.status) {
                    element
                        .parent()
                        .html(
                            `<button type="button"  class="btn btn-sm text-dark p-0">Added to Cart</button>`
                        );
                    getCartCount();
                }
            },
        });
    });
});

function updateQty(qty, url) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: url,
        type: "POST",
        data: {
            quantity: qty,
        },
        success: function (res) {
            console.log(res);
            // window.location.reload();
        },
    });
}
