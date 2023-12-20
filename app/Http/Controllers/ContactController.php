<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //direct page
    public function contactPage(){
        return view('user.contact.form');
    }

    //data
    public function contact(Request $request){
      $pizza = Product::get();
      $category = Category::get();
      $cart = Cart::where('user_id',Auth::user()->id)->get();
      $order = Order::where('user_id',Auth::user()->id)->get();
      $this->validateCheck($request);
      $data = $this->getData($request);
      Contact::create($data);

      return view('user.main.home',compact('category','pizza','cart','order'));
    }

    //get data
    private function getData($request){
        return [
            'name' => $request->name ,
            'email' => $request->email ,
            'message' => $request->message
        ];
    }

    private function validateCheck($request){
        Validator::make($request->all(),[
            'name' => 'required' ,
            'email' => 'required' ,
            'message'=> 'required'
        ])->validate();
    }
}
