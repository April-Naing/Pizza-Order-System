@extends('user.layout.master')

@section('content')

    <!-- Cart Start -->
    <div class="container-fluid" style="height: 400px">
        <div class="row px-xl-5">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($order as $o)
                        <tr>
                            <td class="align-middle" >{{$o->created_at->format('F j Y')}}</td>
                            <td class="align-middle" >{{$o->order_code}}</td>
                            <td class="align-middle" >{{$o->total_price}}</td>
                            <td class="align-middle" >
                                @if ($o->status == 0)
                                <i class="fa-solid fa-clock-rotate-left text-warning me-2"></i><span class="text-warning fw-bold">Pending</span>
                                @elseif ($o->status == 1)
                                    <i class="fa-solid fa-check text-success me-2"></i><span class="text-success fw-bold">Success</span>
                                @elseif ($o->status == 2)
                                    <i class="fa-solid fa-circle-exclamation text-danger me-2"></i><span class="text-danger fw-bold">Reject</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <span>
                    {{$order->links()}}
                </span>
            </div>

        </div>
    </div>
    <!-- Cart End -->
@endsection
