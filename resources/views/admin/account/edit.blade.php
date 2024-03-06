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
                                            <a href="#">
                                                <i class="fas fa-user"></i>Account</a>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <a href="{{ route('account#list') }}">
                                                <i class="fas fa-users"></i>Admin List</a>
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
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center my-3 title-2">Account Profile</h3>
                            </div>

                            <form action="{{ route('account#update', Auth::user()->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6 offset-3 text-center">
                                        @if (Auth::user()->image == null)
                                            <img src="{{ asset('images/default_user.png') }}" class=" img-thumbnail shadow"
                                                style="width: 180px;" />
                                        @else
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}" style="width: 180px;"
                                                alt="{{ Auth::user()->name }}" />
                                        @endif
                                    </div>
                                </div>

                                <div class="row mt-4 col-6 offset-3">
                                    <div class="form-group">
                                        <label for="name" class="control-label mb-1">Name</label>
                                        <input id="name" name="name" type="text"
                                            value="{{ old('name', Auth::user()->name) }}"
                                            class="form-control
                                            @if (session('notMatch')) is-invalid @endif
                                            @error('name') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false">
                                        @error('name')
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
                                        <label for="email" class="control-label mb-1">Email</label>
                                        <input id="email" name="email" type="email"
                                            value="{{ old('email', Auth::user()->email) }}"
                                            class="form-control
                                            @if (session('notMatch')) is-invalid @endif
                                            @error('email') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false">
                                        @error('email')
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
                                        <label for="phone" class="control-label mb-1">Phone</label>
                                        <input id="phone" name="phone" type="number"
                                            value="{{ old('phone', Auth::user()->phone) }}"
                                            class="form-control
                                            @if (session('notMatch')) is-invalid @endif
                                            @error('phone') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false">
                                        @error('phone')
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
                                    {{-- Gender --}}
                                    <div class="form-group">
                                        <label for="gender" class="control-label mb-1">Gender</label>
                                        <select name="gender" id="gender"
                                            class="form-select @error('gender') is-invalid  @enderror">
                                            <option value="">Choose Gender</option>
                                            <option value="male" @if (Auth::user()->gender == 'male') selected @endif>
                                                Male
                                            </option>
                                            <option value="female" @if (Auth::user()->gender == 'female') selected @endif>
                                                Female
                                            </option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="control-label mb-1">Address</label>
                                        <textarea id="address" name="address" type="text"
                                            class="form-control
                                            @if (session('notMatch')) is-invalid @endif
                                            @error('address') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false"> {{ old('address', Auth::user()->address) }}
                                        </textarea>
                                        @error('address')
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
                                    {{-- Image --}}
                                    <div class="form-group">
                                        <input type="file" name="image"
                                            class="form-control mt-3 @error('image') is-invalid @enderror">
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="">Role</label>
                                        <input type="text" name="role" class="form-control text-capitalize"
                                            placeholder="Admin" value="{{ old('role', Auth::user()->role) }}" disabled>
                                    </div>

                                    <div class="row col-6 offset-3">
                                        <a href="">
                                            <button type="submit" class="w-100 btn btn-primary">
                                                Update
                                                <i class="fas fa-arrow-alt-circle-right fa-lg ms-1"></i>
                                            </button>
                                        </a>
                                    </div>
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
