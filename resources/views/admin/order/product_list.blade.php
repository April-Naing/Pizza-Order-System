@extends('admin.layout.master')

@section('title', 'Admin Dashboard')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <a href="{{ route('order#list') }}" class="text-decoration-none text-dark">
                                    <i class="fa-solid fa-left-long" ></i> Back
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card col-7">
                        <div class="card-body">
                            <div style="border-bottom: 1px solid black;" class="mb-3">
                                <h3><i class="fa-solid fa-clipboard"></i> Order Info <small class="text-warning fs-6">(Deli Charges Included)</small></h3>
                            </div>

                            <div class="row my-2">
                               <div class="col-6"> <i class="fa-solid fa-circle-user me-2"></i>Customer Name</div>
                               <div class="col-6">{{strtoupper($orderList[0]->user_name)}}</div>
                            </div>

                            <div class="row my-2">
                                <div class="col-6"> <i class="fa-solid fa-barcode me-2"></i></i>Order Code</div>
                                <div class="col-6">{{$orderList[0]->order_code}}</div>
                            </div>

                            <div class="row my-2">
                                <div class="col-6"> <i class="fa-solid fa-money me-2"></i>Total Price</div>
                                <div class="col-6">{{$order->total_price}}</div>
                            </div>

                            <div class="row my-2">
                                <div class="col-6"> <i class="fa-solid fa-calendar me-2"></i>Date</div>
                                <div class="col-6">{{$orderList[0]->created_at->format('F-j-Y')}}</div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Order ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                            @foreach ($orderList as $o)
                            <tr class="tr-shadow">
                                <td class="col-0"></td>
                                <td >{{$o->id}}</td>
                                <td >{{$o->product_name}}</td>
                                <td >
                                    <img src="{{ asset('storage/'.$o->image)}}" alt="" class="img-thumbnail w-50">
                                </td>
                                <td >{{$o->qty}}</td>
                                <td>{{$o->total_price}}</td>
                                {{-- <td >{{$o->created_at->format('F-j-Y')}}</td> --}}
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="">
                            {{-- {{$order->links()}} --}}
                            {{-- {{$pizzas->appends(request()->query())->links()}} --}}
                        </div>

                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection


