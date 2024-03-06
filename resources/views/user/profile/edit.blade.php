@extends('user/layouts/master')

@section('content')
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

                            <form action="{{ route('account#updatePage', Auth::user()->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6 offset-3 text-center">
                                        @if (Auth::user()->image == null)
                                            <img src="{{ asset('images/default_user.png') }}" class="img-thumbnail shadow"
                                                style="width: 180px;" />
                                        @else
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                                class="img-thumbnail shadow" style="width: 180px;"
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
                                        {{-- <a href="{{ route('account#updatePage', Auth::user()->id) }}"> --}}
                                        <button type="submit" class="w-100 btn btn-primary">
                                            Update
                                            <i class="fas fa-arrow-alt-circle-right fa-lg ms-1"></i>
                                        </button>
                                        {{-- </a> --}}
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
