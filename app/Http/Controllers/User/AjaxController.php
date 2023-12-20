<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Orderlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //pizza list
    public function pizzaList(Request $request){
        if($request->status == 'desc'){
            $data = Product::orderBy('created_at','desc')->get();
        }else{
            $data = Product::orderBy('created_at','asc')->get();
        }

        return $data;
    }

    //pizza cart
    public function addToCart(Request $request){
      $data = $this->getOrderData($request);
      logger($data);
      Cart::create($data);
      $response = [
        'message' => 'Add to Cart Complete' ,
        'status' => 'success'
      ];
      return response()->json($response,200);
    }

    //clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    //clear current product
    public function clearCurrentProduct(Request $request){
        Cart::where('user_id',Auth::user()->id)
              ->where('product_id',$request->product_id)
              ->where('id',$request->cart_id)
              ->delete();
    }

    //increase view count
    public function increaseViewCount(Request $request){
        $pizza = Product::where('id',$request->productId)->first();

        $viewCount = [
            'view_count' => $pizza->view_count+1
        ];

        Product::where('id',$request->productId)->update($viewCount);
    }

    // order
    public function order(Request $request){
        $total = 0;
       foreach($request->all() as $item){
          $data = Orderlist::create([
            'user_id' => $item['user_id'] ,
            'product_id' => $item['product_id'] ,
            'qty' => $item['qty'],
            'total_price' => $item['total_price'],
            'order_code' => $item['order_code']
          ]);

          $total += $data->total_price+3000;
       }

       Cart::where('user_id',Auth::user()->id)->delete();

       Order::create([
        'user_id' => Auth::user()->id,
        'order_code' => $data->order_code ,
        'total_price' => $total
       ]);

       return response()->json([
        'status' => 'success' ,
        'message' => 'Order Complete'
       ],200);
    }

    //get order data
    private function getOrderData($request){
        return [
            'user_id' => $request->userId ,
            'product_id' => $request->pizzaId ,
            'qty' => $request->count ,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
