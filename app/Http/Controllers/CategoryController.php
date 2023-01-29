<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // direct category list page
    public function list() {
    $categories = Category::
                  when(request('key'), function($query){
                    $query->where('name', 'like', '%'.request('key').'%');
                  })
                  ->orderBy('category_id','desc')
                  ->paginate(5);
          $categories->appends(request()->all());        
          return view('admin.category.list', compact('categories'));
    }

    //direct category create page
    public function createPage() {
        return view('admin.category.create');
    }
    
    //create category
    public function create(Request $request) {
        $this->categoryValidationCheck($request);
        $data = $this->requestCategoryData($request);
        Category::create($data);
        return redirect()->route('category#list');
    }

    // delete category
    public function delete($id) {
        // dd($id);
        Category::where('category_id', $id)->delete();
        return back()->with(['deleteSuccess'=>'Category Deleted...']);
    }

    //category validation check
    private function categoryValidationCheck($request) {
        Validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,name'
        ])->validate();
    }

    //request category Data
    private function requestCategoryData($request) {
        return [
            'name' => $request->categoryName
        ];
    }
}
