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
                            {{-- <a href="{{ route('product#list') }}">
                                <button class="btn border">
                                    <i class="fa-solid fa-arrow-left"></i>
                                </button>
                            </a> --}}
                            <button class="btn border" onclick="history.back()">
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                            <div class="card-title">
                                <h3 class="text-center my-3 title-2">Edit Products</h3>
                            </div>

                            {{-- Form --}}
                            <form action="{{ route('product#update', $pizzas->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6 offset-3 text-center">
                                        @if ($pizzas->image == null)
                                            <img src="{{ asset('images/default_user.png') }}" class=" img-thumbnail shadow"
                                                style="width: 180px;" />
                                        @else
                                            <img src="{{ asset('storage/' . $pizzas->image) }}" style="width: 180px;"
                                                alt="{{ $pizzas->name }}" />
                                        @endif
                                    </div>
                                </div>

                                {{-- Name --}}
                                <div class="row mt-4 col-6 offset-3">
                                    <div class="form-group">
                                        <label for="name" class="control-label mb-1">Name</label>
                                        <input id="name" name="pizzaName" type="text"
                                            value="{{ old('pizzaName', $pizzas->name) }}"
                                            class="form-control @error('pizzaName') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false">
                                        @error('pizzaName')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- Category --}}
                                    <div class="form-group">
                                        <label for="category" class="control-label mb-1">Category</label>
                                        <select name="pizzaCategory" id="category"
                                            class="form-select @error('pizzaCategory') is-invalid  @enderror">
                                            <option value="">Choose Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if ($pizzas->category_id == $category->id) selected @endif>
                                                    {{ $category->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('pizzaCategory')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- Description --}}
                                    <div class="form-group">
                                        <label for="description" class="control-label mb-1">Description</label>
                                        <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid  @enderror"
                                            id="description" cols="30" rows="10">{{ $pizzas->description }}</textarea>
                                        @error('pizzaDescription')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- Price --}}
                                    <div class="form-group">
                                        <label for="price" class="control-label mb-1">Price</label>
                                        <input id="price" name="pizzaPrice" type="number"
                                            value="{{ old('pizzaPrice', $pizzas->price) }}"
                                            class="form-control
                                            @error('pizzaPrice') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false">
                                        @error('pizzaPrice')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- Waiting time --}}
                                    <div class="form-group">
                                        <label for="waiting_time" class="control-label mb-1">Waiting time</label>
                                        <input id="waiting_time" name="pizzaWaiting" type="text"
                                            value="{{ old('pizzaWaiting', $pizzas->waiting_time) }}"
                                            class="form-control
                                            @error('pizzaWaiting') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false">
                                        @error('waiting_time')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    {{-- View count --}}
                                    <div class="form-group mt-1">
                                        <label for="">View Count</label>
                                        <input type="text" name="role" class="form-control text-capitalize"
                                            placeholder="" value="{{ old('role', $pizzas->view_count) }}" disabled>
                                    </div>

                                    {{-- Image --}}
                                    <div class="form-group">
                                        <input type="file" name="pizzaImage"
                                            class="form-control mt-3 @error('pizzaImage') is-invalid @enderror">
                                        @error('pizzaImage')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- Button --}}
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
