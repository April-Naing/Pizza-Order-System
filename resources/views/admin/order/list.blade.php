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
                                <h2 class="title-1">Order List</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <form action="{{route('order#statusChange')}}" method="GET" class="col-7 mt-2">
                            <div class="input-group">
                                <span class="input-group-text" ><i class="fa-sharp fa-solid fa-database me-2 ms-1"></i> {{count($order)}}</span>
                                <select name="orderStatus" class="form-select col-3" id="inputGroupSelect04" aria-label="Example select with button addon">
                                    <option value="">All</option>
                                    <option value="0" @if (request('orderStatus' ) == '0') selected @endif>Pending</option>
                                    <option value="1" @if (request('orderStatus' ) == '1') selected @endif>Success</option>
                                    <option value="2" @if (request('orderStatus' ) == '2') selected @endif>Reject</option>
                                </select>
                                <button type="submit" class="btn btn-outline-secondary bg-dark text-white">Search</button>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Order Date</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                            @foreach ($order as $o)
                            <tr class="tr-shadow">
                                <td >{{$o->user_id}}
                                    <input type="hidden" name="" class="orderId" value="{{$o->id}}">
                                </td>
                                <td >{{$o->user_name}}</td>
                                <td >
                                    <a href="{{ route('order#productList',$o->order_code)}}" class="text-decoration-none">{{$o->order_code}}</a>
                                </td>
                                <td class="amount">{{$o->total_price}} kyats</td>
                                <td >
                                    <select name="" id="" class="form-control statusChange">
                                        <option value="0" @if ($o->status == 0) selected @endif>Pending</option>
                                        <option value="1" @if ($o->status == 1) selected @endif>Success</option>
                                        <option value="2" @if ($o->status == 2) selected @endif>Reject</option>
                                    </select>
                                </td>
                                <td class="col-2">{{$o->created_at->format('F-j-Y')}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
@endsection

@section('scriptSource')
    <script>
       $(document).ready(function(){
            // $('#orderStatus').change(function(){
            //     $status = $('#orderStatus').val();

            //     $.ajax({
            //         type : 'get',
            //         url : 'http://127.0.0.1:8000/admin/order/ajax/status',
            //         data : { 'status' : $status} ,
            //         dataType : 'json' ,
            //         success : function(response){

            //           $list = '';
            //           for($i=0;$i<response.length;$i++){

            //             $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
            //             $dbDate = new Date(response[$i].created_at);
            //             $finalDate = $months[$dbDate.getMonth()] + "-" + $dbDate.getDate() + "-" + $dbDate.getFullYear() ;

            //             if(response[$i].status == 0){
            //                 $statusMessage = `<select name="" id="" class="form-control">
            //                     <option value="0" selected>Pending</option>
            //                     <option value="1" >Success</option>
            //                     <option value="2">Reject</option>
            //                 </select>`;
            //             }else if(response[$i].status == 1){
            //                 $statusMessage = `<select name="" id="" class="form-control">
            //                     <option value="0">Pending</option>
            //                     <option value="1"  selected>Success</option>
            //                     <option value="2">Reject</option>
            //                 </select>`;
            //             }else if(response[$i].status == 2){
            //                 $statusMessage = `<select name="" id="" class="form-control">
            //                     <option value="0">Pending</option>
            //                     <option value="1">Success</option>
            //                     <option value="2" selected>Reject</option>
            //                 </select>`;
            //             }

            //             $list += `<tr class="tr-shadow">
            //                     <td >${response[$i].user_id}</td>
            //                     <td >${response[$i].user_name}</td>
            //                     <td >${response[$i].order_code}</td>
            //                     <td >${response[$i].total_price} kyats</td>
            //                     <td >${$statusMessage}</td>
            //                     <td class="col-2">${$finalDate}</td>
            //                 </tr>
            //             `;
            //           }

            //           $('#dataList').html($list)
            //         }
            //     })

            // })

            $('.statusChange').change(function(){
                $currentStatus = $(this).val();
                $parentNode = $(this).parents("tr");
                $orderId = $parentNode.find('.orderId').val();

                $data = {
                    'status' : $currentStatus ,
                    'orderId' : $orderId
                };

                console.log($data)

                $.ajax({
                    type : 'get' ,
                    url :  'http://127.0.0.1:8000/admin/order/ajax/change/status',
                    data : $data ,
                    dataType : 'json' ,
                })
                location.reload()
            })


       })
    </script>
@endsection
