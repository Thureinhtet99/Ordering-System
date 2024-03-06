@extends('user/layouts/master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid" style="height: 450px;">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                {{-- Table --}}
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            {{-- <th>Products</th> --}}
                            <th>Order Code</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="tableBody">
                        @foreach ($orders as $order)
                            <tr>
                                <td class="align-middle">{{ $order->order_code }}</td>
                                <td class="align-middle">{{ $order->total_price }}</td>
                                <td class="align-middle">
                                    @if ($order->status == 0)
                                        <p class="rounded-3 text-warning">
                                            <i class="fa-solid fa-clock me-2"></i>
                                            Pending
                                        </p>
                                    @elseif ($order->status == 1)
                                        <p class="rounded-3 text-success">
                                            <i class="fa-solid fa-check me-2"></i>
                                            Success
                                        </p>
                                    @elseif ($order->status == 2)
                                        <p class="rounded-3 text-danger">
                                            <i class="fa-solid fa-circle-exclamation me-2"></i>
                                            Reject
                                        </p>
                                    @endif
                                </td>
                                <td class="align-middle">{{ $order->created_at->format('F j Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="my-3">{{ $orders->links() }}</div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Contact Javascript File -->
    {{-- <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script> --}}

    <!-- Template Javascript -->
    {{-- <script src="js/main.js"></script> --}}
@endsection
