<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //home page
    public function home(){
        $pizza = Product::get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $order = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','order'));
    }

    //filter pizza
    public function filter($categoryId){
        $pizza = Product::where('category_id',$categoryId)->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $order = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','order'));
    }

    //pizza detail
    public function detail($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.detail',compact('pizza','pizzaList'));
    }

    //cart list
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)->get();

        $totalPrice = 0;
        foreach($cartList as $c){
            $totalPrice += $c->pizza_price * $c->qty;
        }

        return view('user.main.cart',compact('cartList','totalPrice'));
    }

    //history
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)
                 ->orderBy('created_at','desc')
                 ->paginate(6);
        return view('user.main.history',compact('order'));
    }

    //password change page
    public function changePwPage(){
        return view('user.password.change');
    }

    //password change
    public function changePw(Request $request){
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbpassword = $user->password;

        if(Hash::check($request->oldPassword,$dbpassword)){
            $data = [
                'password' => Hash::make($request->newPassword)
            ];

            User::where('id',Auth::user()->id)->update($data);

            return back()->with(['change' => 'Password Change process success']);
        }

        return back()->with(['notmatch' => 'Old Password Incorrect.Try Again!']);
    }

    //account change page
    public function accountChangePage(){
        return view('user.profile.account');
    }

    //update account
    public function accountChange($id,Request $request){
       $this->updateValidationCheck($request);
       $data = $this->updateData($request);

      //for image
       if($request->hasFile('image')){
          $dbImage = User::where('id',$id)->first();
          $dbImage = $dbImage->image;

          if($dbImage != null){
            Storage::delete('public/'.$dbImage);
          }

          $fileName  = uniqid() . $request->file('image') -> getClientOriginalName();
          $request->file('image')->storeAs('public',$fileName);
          $data['image'] = $fileName;
       }
      User::where('id',$id)->update($data);

      return back()->with(['updateSuccess' => 'Admin Account Update Success!']);
    }


    //account validation check
    private function updateValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'gender' => 'required',

        ])->validate();
    }

     //account update request data
    private function updateData($request){
        return[
         'name' => $request->name,
         'email' => $request->email,
         'address' => $request->address,
         'phone' => $request->phone,
         'gender' => $request->gender,
         'updated_at'=> Carbon::now(),
        ];
    }

    //Password Validation Check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
           'oldPassword' => 'required | min:6 | max:10' ,
           'newPassword' => 'required | min:6 | max:10' ,
           'confirmPassword' => 'required | min:6 | max:10 | same:newPassword'
        ])->validate();
    }
}
