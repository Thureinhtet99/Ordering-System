@extends('admin.layouts.app')

@section('title', 'adminCategoryList')

@section('content')

    <!-- HEADER DESKTOP-->
    <header class="header-desktop">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="header-wrap">

                    {{-- Search box --}}
                    <form class="form-header" action="{{ route('admin#order#list') }}" method="get">
                        @csrf
                        <input class="au-input au-input--xl" type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search for datas &amp; reports..." />
                        <button class="au-btn--submit" type="submit">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                    </form>

                    <div class="header-button">
                        <div class="noti-wrap">
                            <div class="noti__item js-item-menu">
                                <i class="zmdi zmdi-notifications"></i>
                                <span class="quantity">3</span>
                                <div class="notifi-dropdown js-dropdown">
                                    <div class="notifi__title">
                                        <p>You have 3 Notifications</p>
                                    </div>
                                    <div class="notifi__item">
                                        <div class="bg-c1 img-cir img-40">
                                            <i class="zmdi zmdi-email-open"></i>
                                        </div>
                                        <div class="content">
                                            <p>You got a email notification</p>
                                            <span class="date">April 12, 2018 06:50</span>
                                        </div>
                                    </div>
                                    <div class="notifi__item">
                                        <div class="bg-c2 img-cir img-40">
                                            <i class="zmdi zmdi-account-box"></i>
                                        </div>
                                        <div class="content">
                                            <p>Your account has been blocked</p>
                                            <span class="date">April 12, 2018 06:50</span>
                                        </div>
                                    </div>
                                    <div class="notifi__item">
                                        <div class="bg-c3 img-cir img-40">
                                            <i class="zmdi zmdi-file-text"></i>
                                        </div>
                                        <div class="content">
                                            <p>You got a new file</p>
                                            <span class="date">April 12, 2018 06:50</span>
                                        </div>
                                    </div>
                                    <div class="notifi__footer">
                                        <a href="#">All notifications</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="account-wrap">
                            <div class="account-item clearfix js-item-menu">
                                <div class="image">
                                    @if (Auth::user()->image == null)
                                        <img src="{{ asset('images/default_user.png') }}" class=" img-thumbnail shadow"
                                            style="width: 180px;" />
                                    @else
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}" style="width: 180px;"
                                            alt="{{ Auth::user()->name }}" />
                                    @endif
                                </div>
                                <div class="content">
                                    <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <div class="image">
                                            <a href="#">
                                                @if (Auth::user()->image == null)
                                                    <img src="{{ asset('images/default_user.png') }}"
                                                        class=" img-thumbnail shadow" style="width: 180px;" />
                                                @else
                                                    <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                        style="width: 180px;" alt="{{ Auth::user()->name }}" />
                                                @endif
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="name">
                                                <a href="#">{{ Auth::user()->name }}</a>
                                            </h5>
                                            <span class="email">{{ Auth::user()->email }}</span>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="{{ route('account#detail') }}">
                                                <i class="fas fa-user"></i>Account</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="{{ route('account#detail') }}">
                                                <i class="fas fa-users"></i>Admin List</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="{{ route('admin#password#change') }}">
                                                <i class="fas fa-key"></i>Change Password</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__footer">
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button class="btn p-3 w-100 hover" type="submit">
                                                <i class="zmdi zmdi-power mx-2"></i><span class="mx-2">Logout</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER DESKTOP-->

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <a href="{{ route('admin#order#list') }}">
                        <button class="btn">
                            <i class="fa-solid fa-arrow-left me-1"></i>
                            Back
                        </button>
                    </a>

                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap mt-3">
                                <h2 class="title-1">Order List</h2>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive table-responsive-data2">

                        {{-- Card --}}
                        <div class="row col-5">
                            <div class="card rounded">
                                <h4 class="card-header">Order Info</h4>
                                <div class="card-body py-1">
                                    <div class="row">
                                        <div class="col">
                                            <p class="card-text">
                                                <i class="fa-solid fa-user me-2"></i>
                                                <small>Customer Name</small>
                                            </p>
                                            <p class="card-text">
                                                <i class="fa-solid fa-barcode me-2"></i>
                                                <small>Order Code</small>
                                            </p>
                                            <p class="card-text">
                                                <i class="fa-regular fa-calendar-days me-2"></i>
                                                <small>Order Date</small>
                                            </p>
                                            <p class="card-text">
                                                <i class="fa-solid fa-dollar-sign me-2"></i>
                                                <small>Total Price</small>
                                            </p>
                                        </div>
                                        <div class="col">
                                            <p class="card-text"><small>{{ $orderList[0]->user_name }}</small></p>
                                            <p class="card-text"><small>{{ $orderList[0]->order_code }}</small></p>
                                            <p class="card-text">
                                                <small>{{ $orderList[0]->created_at->format('j F Y') }}</small>
                                            </p>
                                            <p class="card-text"><small>{{ $orders->total_price }} Kyats </small></p>

                                            <p class="text-warning"style="font-size: 10px;">
                                                <i class="fa-solid fa-triangle-exclamation 2xs"></i>
                                                Including Delivery Charges
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-striped table-data2">
                            {{-- @if (count($orders) != 0) --}}
                            <thead>
                                <tr class="table-dark">
                                    <th class="text-white">ID</th>
                                    <th class="text-white">User ID</th>
                                    <th class="text-white">Product Image</th>
                                    <th class="text-white">Product Name</th>
                                    <th class="text-white">Quatity</th>
                                    <th class="text-white text-center">Total</th>
                                    <th class="text-white text-center">Status</th>
                                    <th class="text-white text-center">Date</th>
                                </tr>
                            </thead>

                            <tbody id="dataList">

                                {{-- Table Row --}}
                                @foreach ($orderList as $list)
                                    <tr class="tr-shadow my-2">
                                        <input type="hidden" name="orderID" id="orderID"
                                            value="{{ $list->id }}">
                                        <td>{{ $list->id }}</td>
                                        <td class="text-center">{{ $list->user_id }}</td>
                                        <td class="col-2">
                                            <img src="{{ asset('storage/' . $list->product_image) }}"
                                                alt="{{ $list->user_name }}">
                                        </td>
                                        <td class="fw-medium fs-6">{{ $list->product_name }}</td>
                                        <td class="text-center">{{ $list->qty }}</td>
                                        <td>{{ $list->total }} kyats </td>
                                        <td>
                                            <select name="status" id="status" disabled
                                                class="form-control statusChange text-center
                                                    @if ($list->status == 0) text-warning @endif
                                                    @if ($list->status == 1) text-success @endif
                                                    @if ($list->status == 2) text-danger @endif">
                                                <option value="0" class="form-control"
                                                    @if ($list->status == 0) selected @endif>
                                                    Pending
                                                </option>
                                                <option value="1" class="form-control"
                                                    @if ($list->status == 1) selected @endif>
                                                    Accept
                                                </option>
                                                <option value="2" class="form-control"
                                                    @if ($list->status == 2) selected @endif>
                                                    Reject
                                                </option>
                                            </select>
                                        </td>
                                        <td class="text-center">{{ $list->created_at->format('j F Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{-- @else
                                <p>There is no order</p>
                            @endif --}}
                        </table>
                        <div class="my-2">
                            {{-- {{ $orders->links() }} --}}
                        </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
