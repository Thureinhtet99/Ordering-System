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
                                    @if ($accounts->image == null)
                                        <img src="{{ asset('images/default_user.png') }}" class=" img-thumbnail shadow"
                                            style="width: 180px;" />
                                    @else
                                        <img src="{{ asset('storage/' . $accounts->image) }}" style="width: 180px;"
                                            alt="{{ $accounts->name }}" />
                                    @endif
                                </div>
                                <div class="content">
                                    <a class="js-acc-btn" href="#">{{ $accounts->name }}</a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="info clearfix">
                                        <div class="image">
                                            <a href="#">
                                                @if ($accounts->image == null)
                                                    <img src="{{ asset('images/default_user.png') }}"
                                                        class=" img-thumbnail shadow" style="width: 180px;" />
                                                @else
                                                    <img src="{{ asset('storage/' . $accounts->image) }}"
                                                        style="width: 180px;" alt="{{ $accounts->name }}" />
                                                @endif
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h5 class="name">
                                                <a href="#">{{ $accounts->name }}</a>
                                            </h5>
                                            <span class="email">{{ $accounts->email }}</span>
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
                                <h3 class="text-center my-3 title-2">Change Role</h3>
                            </div>

                            <form action="{{ route('account#changeRole', $accounts->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6 offset-3 text-center">
                                        @if ($accounts->image == null)
                                            <img src="{{ asset('images/default_user.png') }}" class=" img-thumbnail shadow"
                                                style="width: 180px;" />
                                        @else
                                            <img src="{{ asset('storage/' . $accounts->image) }}" style="width: 180px;"
                                                alt="{{ $accounts->name }}" />
                                        @endif
                                    </div>
                                </div>

                                <div class="row mt-4 col-6 offset-3">
                                    <div class="form-group">
                                        <label for="name" class="control-label mb-1">Name</label>
                                        <input id="name" disabled name="name" type="text"
                                            value="{{ old('name', $accounts->name) }}"
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
                                        <input id="email" disabled name="email" type="email"
                                            value="{{ old('email', $accounts->email) }}"
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
                                        <input id="phone" disabled name="phone" type="number"
                                            value="{{ old('phone', $accounts->phone) }}"
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
                                        <select name="gender" id="gender" disabled
                                            class="form-control @error('gender') is-invalid  @enderror">
                                            <option value="">Choose Gender</option>
                                            <option value="male" @if ($accounts->gender == 'male') selected @endif>
                                                Male
                                            </option>
                                            <option value="female" @if ($accounts->gender == 'female') selected @endif>
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
                                        <textarea id="address" disabled name="address" type="text"
                                            class="form-control
                                            @if (session('notMatch')) is-invalid @endif
                                            @error('address') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false"> {{ old('address', $accounts->address) }}
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
                                        <input type="file" name="image" disabled
                                            class="form-control mt-3 @error('image') is-invalid @enderror">
                                        @error('image')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="">Role</label>
                                        <select name="role" id="role" class="form-select">
                                            <option value="admin" @if ($accounts->role == 'admin') selected @endif>Admin
                                            </option>
                                            <option value="user" @if ($accounts->role == 'user') selected @endif>User
                                            </option>
                                        </select>
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
