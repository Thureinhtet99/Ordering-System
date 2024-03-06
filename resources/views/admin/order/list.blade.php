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
                                            <a href="{{ route('userList#index') }}">
                                                <i class="fa-solid fa-user-group"></i>User List</a>
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
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>

                            </div>
                        </div>
                    </div>

                    {{-- Search key --}}
                    <div class="d-flex justify-content-between">
                        <p class="text-capitalize my-1">
                            <small>search key : <b>{{ request('search') }}</b></small>
                        </p>
                        {{-- Total --}}
                        <p class="text-capitalize my-1">
                            <small>total : <b>{{ count($orders) }}</b></small>
                        </p>
                    </div>

                    <form action="{{ route('admin#order#listChange') }}" method="get">
                        @csrf
                        <div class="col-3 p-0  mt-2 mb-4 d-flex align-items-center">
                            <label for="status" class="form-label mt-1">Status</label>
                            <select name="status" id="status" class="form-select mx-2">
                                <option value="">All</option>
                                <option value="0" @if (request('status') == '0') selected @endif
                                    class="text-warning">Pending</option>
                                <option value="1" @if (request('status') == '1') selected @endif
                                    class="text-success">Accept</option>
                                <option value="2" @if (request('status') == '2') selected @endif
                                    class="text-danger">Reject</option>
                            </select>
                            <button type="submit" class="btn bg-dark text-white">Search</button>
                        </div>
                    </form>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-striped table-data2">
                            @if (count($orders) != 0)
                                <thead>
                                    <tr class="table-dark">
                                        <th class="text-white">ID</th>
                                        <th class="text-white">User ID</th>
                                        <th class="text-white">User Name</th>
                                        <th class="text-white">Order Code</th>
                                        <th class="text-white">Total</th>
                                        <th class="text-white">Status</th>
                                        <th class="text-white">Date</th>
                                    </tr>
                                </thead>

                                <tbody id="dataList">

                                    {{-- Table Row --}}
                                    @foreach ($orders as $order)
                                        <tr class="tr-shadow my-2">
                                            <input type="hidden" name="orderID" id="orderID"
                                                value="{{ $order->id }}">
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->user_id }}</td>
                                            <td class="fw-medium fs-6">{{ $order->user_name }}</td>
                                            <td class="desc">
                                                <a href="{{ route('admin#order#orderCodeStatus', $order->order_code) }}"
                                                    class="text-decoration-none">{{ $order->order_code }}</a>
                                            </td>
                                            <td>{{ $order->total_price }} kyats </td>
                                            <td>
                                                <select name="status" id="status"
                                                    class="form-select statusChange
                                                        @if ($order->status == 0) text-warning @endif
                                                        @if ($order->status == 1) text-success @endif
                                                        @if ($order->status == 2) text-danger @endif">
                                                    <option value="0" class="form-control"
                                                        @if ($order->status == 0) selected @endif>
                                                        Pending
                                                    </option>
                                                    <option value="1" class="form-control"
                                                        @if ($order->status == 1) selected @endif>
                                                        Accept
                                                    </option>
                                                    <option value="2" class="form-control"
                                                        @if ($order->status == 2) selected @endif>
                                                        Reject
                                                    </option>
                                                </select>
                                            </td>
                                            <td>{{ $order->created_at->format('j F Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                <p>There is no order</p>
                            @endif
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

@section('scriptSource')
    <script>
        $(document).ready(function() {
            $(".statusChange").change(function() {
                $statusChange = $(this).val();
                $orderID = $(this).parents("tr").find("#orderID").val();

                $.ajax({
                    type: "get",
                    url: "/admin/order/list/statuschange/ajax",
                    data: {
                        "orderID": $orderID,
                        "status": $statusChange,
                    },
                    dataType: "json",
                })
                // location.reload();
            })
        })
    </script>
@endsection
