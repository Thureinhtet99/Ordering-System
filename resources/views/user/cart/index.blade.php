@extends('user/layouts/master')

@section('content')

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">

                {{-- Table --}}
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="tableBody">
                        @foreach ($carts as $cart)
                            <tr>
                                {{-- Hidden --}}
                                <input type="hidden" name="cartID" id="cartID" value="{{ $cart->id }} ">
                                <input type="hidden" name="productID" id="productID" value="{{ $cart->product_id }} ">
                                <input type="hidden" name="userID" id="userID" value="{{ $cart->user_id }}">

                                <td class="align-middle">
                                    <img src="{{ asset('storage/' . $cart->product_image) }}"
                                        alt="{{ $cart->product_name }}" style="width: 60px;">
                                </td>
                                <td class="align-middle" id=""> {{ $cart->product_name }} kyats </td>
                                <td class="align-middle" id="productPrice"> {{ $cart->product_price }} kyats </td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            id="qty" value="{{ $cart->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle col-3" class="totalProduct" id="productTotal">
                                    {{ $cart->product_price * $cart->qty }}
                                    kyats
                                </td>
                                <td class="align-middle">
                                    <button class="btn btn-sm btn-danger btnRemove">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Cart Summary</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotal">{{ $subtotal }} kyats</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Tax</h6>
                            <h6 class="font-weight-medium">
                                <span class="text-danger" style="font-size: 0.8rem">(2.5%)</span>
                                <span id="tax">{{ $subtotal * 0.025 }} kyats</span>
                            </h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalTotal"> {{ $subtotal + $subtotal * 0.025 }} kyats</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">
                            Proceed To Checkout
                        </button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearCartBtn">
                            Clear Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>

@endsection

@section('scriptSource')
    <script src="{{ asset('js/cartIndex.js') }}"></script>
    <script>
        $(document).ready(function() {

            $("#orderBtn").click(function() {

                $randomNum = "POS" +  Math.floor(Math.random() * 10000001);
                $orderList = [];

                $("#tableBody tr").each(function(index, row) {
                    $orderList.push({
                        "user_id": $(row).find("#userID").val(),
                        "product_id": $(row).find("#productID").val(),
                        "qty": $(row).find("#qty").val(),
                        "total": parseInt($(row).find("#productTotal")
                            .text()
                            .replace("kyats", "")),
                        "order_code": $randomNum,
                    })
                });

                $.ajax({
                    type: "get",
                    url: "/user/ajax/order",
                    data: Object.assign({}, $orderList),
                    dataType: "json",
                    success: function(response) {
                        if (response.status == "true") {
                            window.location.href = "/user/categorypage"
                        }
                    }
                });
                // location.reload();
            });

            // clearCurrentCartBtn
            $(".btnRemove").click(function() {
                $parent = $(this).parents("tr")
                $productID = $parent.find("#productID").val();
                $cartID = $parent.find("#cartID").val();

                $.ajax({
                    type: "get",
                    url: "/user/ajax/clearcurrentcart",
                    data: {
                        "productID": $productID,
                        "cartID": $cartID,
                    },
                    dataType: "json",
                })
                $parent.remove();

                $result = 0;
                $("#tableBody tr").each(function(index, row) {
                    $result += parseInt($(row).find("#productTotal").text().replace("kyats", ""));
                })
                $("#subTotal").html(`${$result} kyats`);
                $("#tax").html(`${$result * 0.025} kyats`);
                $("#finalTotal").html(`${$result + $result * 0.025} kyats`);
            })

            // clearCartBtn
            $("#clearCartBtn").click(function() {

                $.ajax({
                    type: "get",
                    url: "/user/ajax/clearcart",
                    dataType: "json",
                });

                $("#tableBody tr").remove();
                $("#subTotal").html(`0 kyats`);
                $("#tax").html(`0 kyats`);
                $("#finalTotal").html(`0 kyats`);
            })
        });
    </script>
@endsection
