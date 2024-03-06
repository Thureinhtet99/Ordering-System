@extends('admin.layouts.app')

@section('title', 'adminCategoryList')

@section('content')

    <!-- HEADER DESKTOP-->
    <header class="header-desktop">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="header-wrap">
                    <div class="header-button ms-auto">
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
                                    <img src="{{ asset('admin/images/icon/avatar-01.jpg') }}"
                                        alt="{{ Auth::user()->name }}" />
                                </div>
                                <div class="content">
                                    <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <div class="image">
                                            <a href="#">
                                                <img src="{{ asset('admin/images/icon/avatar-01.jpg') }}"
                                                    alt="{{ Auth::user()->name }}" />
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
                                            <a href="#">
                                                <i class="fas fa-user"></i>Account</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="#">
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
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Password</h3>
                            </div>
                            <hr>
                            @if (session('passwordchange'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('passwordchange') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <form action="{{ route('admin#passwordchangeFrom') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                    <input id="cc-payment" name="oldPassword" type="password"
                                        class="form-control
                                        @if (session('notMatch')) is-invalid @endif
                                        @error('oldPassword') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false">
                                    @error('oldPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @if (session('notMatch'))
                                        <div class="invalid-feedback">
                                            {{ session('notMatch') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">New Password</label>
                                    <input id="cc-payment" name="newPassword" type="password"
                                        class="form-control @error('newPassword') is-invalid  @enderror"
                                        aria-required="true" aria-invalid="false">
                                    @error('newPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Confirm Password</label>
                                    <input id="cc-payment" name="confirmPassword" type="password"
                                        class="form-control @error('confirmPassword') is-invalid  @enderror"
                                        aria-required="true" aria-invalid="false">
                                    @error('confirmPassword')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Change Password</span>
                                        <span id="payment-button-sending" style="display:none;">Changing</span>
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection
