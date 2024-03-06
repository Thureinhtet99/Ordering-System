@extends('user/layouts/master')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        price</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <label class="fs-5 fw-bold" for="price-all ">Categories</label>
                            <span class="badge border text-black font-weight-normal ">{{ count($categories) }}</span>
                        </div>
                        <hr>
                        <div class="custom-control d-flex align-items-center justify-content-between mb-3">
                            <a href="{{ route('user#category') }}" class="text-dark">
                                <p class="text-muted m-0">All </p>
                            </a>
                        </div>
                        @foreach ($categories as $category)
                            <div class="custom-control d-flex align-items-center justify-content-between mb-3">
                                <a href="{{ route('user#filter', $category->id) }}" class="text-dark">
                                    <p class="text-muted text-capitalize m-0">
                                        {{ $category->category_name }}
                                    </p>
                                </a>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <select name="sorting" id="sorting" class="form-select">
                                    <option value="">Sorting</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                    {{-- <option value="bestRating">Best Rating</option> --}}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="productsList">
                        @if (count($datas) != 0)
                            @foreach ($datas as $data)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/' . $data->image) }}"
                                                alt="" style="height: 250px; width:300px;">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href="">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>
                                                <a class="btn btn-outline-dark btn-square" href="">
                                                    <i class="far fa-heart"></i></a>
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('user#category#details', $data->id) }}">
                                                    <i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-3">
                                            <p class="h6 text-decoration-none text-truncate">{{ $data->name }}</p>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $data->price }} kyats</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                            <small class="pt-1">{{ $data->view_count + 1 }}
                                                <i class="fa-solid fa-eye mx-1"></i>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">There is no datas</p>
                        @endif
                    </div>

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

            $("#sorting").change(function() {

                $sortingValue = $("#sorting").val();

                if ($sortingValue == "asc") {
                    $.ajax({
                        type: "get",
                        url: "/user/ajax/list",
                        dataType: "json",
                        data: {
                            "status": "asc",
                        },
                        success: function(response) {
                            $lists = "";
                            response.forEach(res => {
                                $lists += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="productsList">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/${res.image}') }}" alt=""
                                             style="height: 250px; width:300px;">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href="">
                                                    <i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="">
                                                    <i class="far fa-heart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="">
                                                    <i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <p class="h6 text-decoration-none text-truncate">${res.name}</p>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${res.price} kyats</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            });
                            $("#productsList").html($lists);
                        }
                    });
                } else if ($sortingValue == "desc") {
                    $.ajax({
                        type: "get",
                        url: "/user/ajax/list",
                        dataType: "json",
                        data: {
                            "status": "desc"
                        },
                        success: function(response) {
                            $lists = "";
                            response.forEach(res => {
                                $lists += `<div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="productsList">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/${res.image}') }}" alt="" style="height: 250px; width:300px;">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href="">
                                                    <i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="">
                                                    <i class="far fa-heart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href="">
                                                    <i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <p class="h6 text-decoration-none text-truncate">${res.name}</p>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${res.price} kyats</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                            });
                            $("#productsList").html($lists);
                        }
                    })
                }
            })
        })
    </script>
@endsection
