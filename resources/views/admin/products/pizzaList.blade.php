@extends('admin.layouts.app')

@section('title', 'adminCategoryList')

@section('content')

    <!-- HEADER DESKTOP-->
    <header class="header-desktop">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="header-wrap">
                    {{-- Search box --}}
                    <form class="form-header" action="{{ route('product#list') }}" method="get">
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
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add products
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    @if (session('deleteSuccess'))
                        <div class="alert alert-warning alert-dismissible fade show p-3" role="alert">
                            <small>{{ session('deleteSuccess') }}</small>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Search key --}}
                    <div class="d-flex justify-content-between">
                        <p class="text-capitalize my-1">
                            <small>search key : <b>{{ request('search`') }}</b></small>
                        </p>
                        {{-- Total --}}
                        <p class="text-capitalize my-1">
                            <small>total : <b>{{ $pizzas->total() }}</b></small>
                        </p>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-striped table-data2">
                            @if (count($pizzas) != 0)
                                <thead>
                                    <tr class="table-dark">
                                        <th class="text-white">Image</th>
                                        <th class="text-white">Pizza Name</th>
                                        <th class="text-white">Pizza Category</th>
                                        <th class="text-white text-center">Pizza Description</th>
                                        <th class="text-white">Pizza Price</th>
                                        <th class="text-white">View Count</th>
                                        <th class="text-white"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Table Row --}}
                                    @foreach ($pizzas as $pizza)
                                        <tr class="tr-shadow my-2">
                                            <td class="col-2"><img src="{{ asset('storage/' . $pizza->image) }}"
                                                    alt="" style="height: 110px;">
                                            </td>
                                            <td class="text-capitalize desc fw-medium">{{ $pizza->name }}</td>
                                            <td class="text-capitalize fw-medium fs-6">{{ $pizza->category_name }}</td>
                                            <td>{{ Str::words($pizza->description, 15, '......') }}</td>
                                            <td>{{ $pizza->price }}</td>
                                            <td><i class="fas fa-eye mx-1"></i>{{ $pizza->view_count }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('product#edit', $pizza->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="More">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#updatePage', $pizza->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{ route('product#delete', $pizza->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                <p>There is no data</p>
                            @endif
                        </table>
                        <div class="my-2">
                            {{ $pizzas->links() }}
                        </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
