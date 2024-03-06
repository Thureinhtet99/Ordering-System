@extends('admin.layouts.app')

@section('title', 'adminCategoryList')

@section('content')

    <!-- HEADER DESKTOP-->
    <header class="header-desktop">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="header-wrap">
                    {{-- Search box --}}
                    <form class="form-header" action="{{ route('account#list') }}" method="get">
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
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Admin List</h2>

                            </div>
                        </div>
                    </div>

                    @if (session('categoryDelete'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <small>{{ session('categoryDelete') }}</small>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Search key --}}
                    <div class="d-flex justify-content-between">
                        <p class="text-capitalize my-1">
                            <small>search key : <b>{{ request('search') }}</b></small>
                        </p>
                        {{-- Total --}}
                        <p class="text-capitalize my-1">
                            <small>total : <b>{{ $admins->total() }}</b></small>
                        </p>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-striped table-data2">
                            @if (count($admins) != 0)
                                <thead>
                                    <tr class="table-dark">
                                        <th class="text-white">ID</th>
                                        <th class="text-white text-center">Image</th>
                                        <th class=""></th>
                                        <th class="text-white">Name</th>
                                        <th class="text-white">Email</th>
                                        <th class="text-white">Gender</th>
                                        <th class="text-white">Phone</th>
                                        <th class="text-white">Address</th>
                                        <th class=""></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Table Row --}}
                                    @foreach ($admins as $admin)
                                        <tr class="tr-shadow my-2 ">
                                            <td>{{ $admin->id }}</td>
                                            <td class="text-center">
                                                @if ($admin->image == null)
                                                    @if ($admin->gender == 'male')
                                                        <img src="{{ asset('images/default_user.png') }}" alt=""
                                                            style="width: 100px;">
                                                    @else
                                                        <img src="{{ asset('images/default_female.jpg') }}"
                                                            alt="" style="width: 100px;">
                                                    @endif
                                                @else
                                                    <img src="{{ asset('storage/' . $admin->image) }}" alt=""
                                                        style="width: 100px;">
                                                @endif
                                            <td>
                                            <td class="text-capitalize fw-medium ">{{ $admin->name }}</td>
                                            <td class="fw-medium">{{ $admin->email }}</td>
                                            <td class="text-capitalize fw-medium">{{ $admin->gender }}</td>
                                            <td class="text-capitalize fw-medium">{{ $admin->phone }}</td>
                                            <td class="text-capitalize fw-medium">{{ $admin->address }}</td>
                                            <td class="text-capitalize fw-medium">
                                                <div class="table-data-feature">
                                                    @if (Auth::user()->id == $admin->id)
                                                    @else
                                                        <a href="{{ route('account#role', $admin->id) }}">
                                                            <button class="item me-1" data-toggle="tooltip"
                                                                data-placement="top" title="Role change">
                                                                <i class="fa-solid fa-person-circle-question fa-lg"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('account#delete', $admin->id) }}">
                                                            <button class="item me-1" data-toggle="tooltip"
                                                                data-placement="top" title="Delete">
                                                                <i class="fas fa-trash-can"></i>
                                                            </button>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                <p>There is no category</p>
                            @endif
                        </table>
                        <div class="my-2">
                            {{ $admins->links() }}
                        </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
