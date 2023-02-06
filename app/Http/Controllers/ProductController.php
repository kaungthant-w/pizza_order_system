<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list
    public function list() {
        $pizzas = Product::when(request('key'), function($query) {
            $query->where('name', 'like', '%'.request('key').'%');
        })
        -> orderBy('created_at', 'desc')->paginate(5);
        $pizzas -> appends(request()->all());
        return view('admin.products.pizzaList', compact('pizzas'));
    }
    
    //direct pizza create page
    public function createPage() {
        $categories = Category::select('id', 'name')->get();
        return view('admin.products.create', compact('categories'));
    }

    // delete pizza
    public function delete($id) {
        Product::where('id', $id) -> delete();
        return redirect()->route('product#list')->with(['deleteSuccess' => 'Product Delete Success...']);
    }

    //edit pizza
    public function edit($id) {
        $pizza = Product::where('id', $id)->first();
        return view('admin.products.edit', compact("pizza"));
    }

    //create product
    public function create(Request $request) {
        $this->productValidationCheck($request);
        $data = $this->requestProductInfo($request);
        // dd($data);

        $fileName = uniqid().$request->file('pizzaImage') -> getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public', $fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('product#list');
    }

    //request product info
    private function requestProductInfo($request) {
        return [
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'description' => $request->pizzaDescription,
            'waiting_time' => $request->pizzaWaitingTime,
            'price' => $request->pizzaPrice
        ];
    }

    //product validation check
    private function productValidationCheck($request) {
        Validator::make($request->all(), [
            'pizzaName' => 'required|min:5|unique:products,name',
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required|min:10',
            'pizzaImage' => 'required|mimes:jpg,png,jpeg|file',
            'pizzaWaitingTime' => 'required',
            'pizzaPrice' => 'required',
        ])->validate();
    }
}
