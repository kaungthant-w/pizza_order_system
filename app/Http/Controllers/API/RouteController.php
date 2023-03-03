<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Contact;
use App\Models\User;
use Carbon\Carbon;

class RouteController extends Controller
{
    //get all product list
    public function productList() {
        $products = Product::get();
        $users = User::get();
        $categories = Category::get();

        $data = [
            // 'product' => [
            //     'code lab' => [
            //         'test' => $products
            //     ]
            // ],
            'product' => $products,
            'user' => $users,
            'category' => $categories,
        ];

        // return $data['product']['code lab']['test'][0]->name;
        // return $data['product']['code lab']['test'][0]->price;
        // return $data['product']['code lab']['test'][1]->name;

        return $data['product'][0]->name;
        return response()->json($data, 200);
    }

    //get all category
    public function categoryList() {
        $category = Category::orderBy('id', 'desc')->get();
        return response()->json($category, 200);
    }

    //create category
    public function createCategory(Request $request) {
        // dd($request->all());
        // dd($request->name);

        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $response = Category::create($data);
        return response()->json($response, 200);
        return $data;
        dd($request->all());

        // dd($request->header('headerData'));
    }

    public function createContact(Request $request) {
        // return $request -> all();

        $data = $this->getContactData($request);
        // return $data;
        Contact::create($data);
        $contact = Contact::orderBy('created_at','desc')->get();
        return response()->json($contact, 200);
    }

    private function getContactData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
