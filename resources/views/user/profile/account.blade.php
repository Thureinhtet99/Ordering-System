@extends('user/layouts/master')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    @if (session('updateSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <small>{{ session('updateSuccess') }}</small>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center my-3 title-2">Account Info</h3>
                            </div>

                            <div class="row">
                                <div class="col-3 offset-1 me-3 text-center">
                                    @if (Auth::user()->image == null)
                                        <img src="{{ asset('images/default_user.png') }}" class="img-thumbnail shadow"
                                            style="width: 200px;" />
                                    @else
                                        <img src="{{ asset('storage/' . Auth::user()->image) }}"
                                            class="img-thumbnail shadow" style="width: 200px;"
                                            alt="{{ Auth::user()->name }}" />
                                    @endif
                                </div>
                                <div class="col-7">
                                    <p class="text-muted mb-2 text-capitalize"><b>Name - </b> {{ Auth::user()->name }}</p>
                                    <p class="text-muted mb-2"><b>Email - </b>{{ Auth::user()->email }}</p>
                                    <p class="text-muted mb-2 text-capitalize"><b>Phone - </b>{{ Auth::user()->phone }}</p>
                                    <p class="text-muted mb-2 text-capitalize"><b>Gender - </b>{{ Auth::user()->gender }}
                                    </p>
                                    <p class="text-muted mb-2 text-capitalize"><b>Address - </b>{{ Auth::user()->address }}
                                    </p>
                                    <p class="text-muted mb-2 text-capitalize"><b>Joined -
                                        </b>{{ Auth::user()->created_at->format('j F Y') }}</p>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-8 offset-4">
                                    <a href="{{ route('account#changePage') }}">
                                        <button class="btn btn-dark text-white">
                                            <i class="fas fa-edit"></i>
                                            Edit
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
