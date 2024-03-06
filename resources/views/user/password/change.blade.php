@extends('user/layouts/master')

@section('content')
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
                            <form action="{{ route('user#changepassword#form') }}" method="post" novalidate="novalidate">
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
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block rounded">
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
@endsection
