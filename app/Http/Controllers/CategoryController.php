<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    public function list(){
        $categories = Category::when(request('key'),function($query){
                      $query->where('name','like','%'.request('key').'%');
                    })
                      ->orderBy('id','desc')->paginate(4);
        return view('admin.category.list',compact('categories'));
    }

    //direct create category page
    public function createPage(){
        return view('admin.category.create');
    }

    //create category
    public function create(Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list');
    }

    //delete data
    public function delete($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Data Delete Success!']);
    }

    //edit
    public function edit($id){
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    //update
    public function update(Request $request){
        $this-> categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::where('id',$request->categoryId)->update($data);
        return redirect()->route('category#list');
    }

    //Validation
    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName' => 'required |min:4 |unique:categories,name,'.$request->categoryId
        ])->validate();
    }

    //request data
    private function requestCategoryData($request){
        return [
            'name' => $request->categoryName
        ];
    }
}
