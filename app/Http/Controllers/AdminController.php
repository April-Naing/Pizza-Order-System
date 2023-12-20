<?php

namespace App\Http\Controllers;

use Storage;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //password change page
    public function changePwPage(){
        return view('admin.account.changePassword');
    }

    //password change
    public function passwordChange(Request $request){
      $this -> passwordValidationCheck($request);

      $user = User::select('password')->where('id',Auth::user()->id)->first();
      $dbpw = $user->password;

      if(Hash::check($request->oldPassword, $dbpw)){
          $data = [
            'password' => Hash::make($request->newPassword)
          ];
          User::where('id',Auth::user()->id)->update($data);

          return back()->with(['change' => 'Password Change process success']);
      }

      return back()->with(['notmatch' => 'Old Password Incorrect.Try Again!']);
    }

    //profile
    public function profile(){
        return view('admin.account.profile');
    }

    //edit profile
    public function edit(){
        return view('admin.account.edit');
    }

    //update
    public function update($id,Request $request){

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

      return redirect()->route('admin#profile')->with(['updateSuccess' => 'Admin Account Update Success!']);
    }

    //admin list
    public function list(){
        $admin = User::when(request('key'),function($query){
                 $query ->orWhere('name','like','%'.request('key').'%')
                        ->orWhere('email','like','%'.request('key').'%')
                        ->orWhere('phone','like','%'.request('key').'%')
                        ->orWhere('address','like','%'.request('key').'%')
                        ->orWhere('gender','like','%'.request('key').'%');
                     })
                ->where('role','admin')
                ->paginate(4);

        return view('admin.account.admin_list',compact('admin'));
    }

    //admin role change
    public function changeRole($id){
        $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }

    //contact message list
    public function messageList(){
        $messages = Contact::paginate(5);
        return  view('admin.user.contact',compact('messages'));
    }

    //delete message
    public function messageDelete($id){
       Contact::where('id',$id)->delete();
       return redirect()->route('admin#contactMessageList');
    }

    //user list
    public function userList(){
        $users = User::where('role','user')->paginate(3);
        return view('admin.user.list',compact('users'));
    }

    //ajax user list
    public function ajaxUserList(Request $request){
        $data = [
            'role' => $request->status
        ];
        User::where('id',$request->userId)->update($data);
    }
    //change
    public function change($id,Request $request){
        $data = $this->getData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list');
    }

    //ajax role change
    public function ajaxChangeRole(Request $request){
        User::where('id',$request->userId)->update([
            'role' => $request->status
        ]);

        return view('admin.account.admin_list');
    }

    //get data
    private function getData($request){
        return[
            'role' => $request->role,
        ];
    }

    //admin list delete
    public function delete($id){
       User::where('id',$id)->delete();
       return back()->with(['deleteSuccess'=>'Admin Account Deleted']);
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

    //account update validation
    private function updateValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            // 'image' => 'required|mimes:jpg,jpeg,png,webp|file',
        ])->validate();
    }

    //pw validation
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required |min:6 |max:10',
            'newPassword' => 'required |min:6 |max:10',
            'confirmPassword' => 'required |min:6 |max:10 |same:newPassword'
        ])->validate();
    }

}
