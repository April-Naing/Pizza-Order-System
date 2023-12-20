<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderlist;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //order list direct page
    public function orderList(){
        $order = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc')
                ->get();

        return view('admin.order.list',compact('order'));
    }

    //product code detail view
    public function productList($orderCode){
        $order = Order::where('order_code',$orderCode)->first();

        $orderList = Orderlist::select('orderlists.*','users.name as user_name','products.name as product_name','products.image')
                    ->leftJoin('users','users.id','orderlists.user_id')
                    ->leftJoin('products','products.id','orderlists.product_id')
                    ->where('order_code',$orderCode)->get();

        return view('admin.order.product_list',compact('orderList','order'));
    }

    //ajax
    public function statusChange(Request $request){
        $order = Order::select('orders.*','users.name as user_name')
        ->leftJoin('users','users.id','orders.user_id')
        ->orderBy('created_at','desc');

        if($request->orderStatus == null ){
            $order = $order->get();
        }else{
            $order = $order->where('orders.status',$request->orderStatus)->get();
        };

        return view('admin.order.list',compact('order'));
    }

    //ajax status change
    public function changeStatus(Request $request){
        Order::where('id',$request->orderId)->update([
            'status' => $request->status
        ]);

        $order = Order::select('orders.*','users.name as user_name')
                ->leftJoin('users','users.id','orders.user_id')
                ->orderBy('created_at','desc')
                ->get();

        return response()->json($order,200);
    }


}
