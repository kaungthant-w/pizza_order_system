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

    // create contact
    public function createContact(Request $request) {
        // return $request -> all();

        $data = $this->getContactData($request);
        // return $data;
        Contact::create($data);
        $contact = Contact::orderBy('created_at','desc')->get();
        return response()->json($contact, 200);
    }



    // delete data 
    // public function deleteCategory(Request $request) {
    //     // return $request->all();

    //     $data = Category::where('id', $request->category_id)->first();
    //     // return $data;

    //     // return isset($data);
    //     // return empty($data);
    //     // return !empty($data);

    //     // dd(isset($data));
    //     if(isset($data)) {
    //         Category::where('id', $request->category_id)->delete();
    //         return response()->json(['status' => true, 'message' => "delete success"], 200);
    //     }

    //     return response()->json(['status' => false, 'message' => "There is no category"], 200);

        
    // }

    public function deleteCategory($id, Request $request) {
        // return $id;
        // return $request->all();
        $data = Category::where('id', $id)->first();
        // dd(isset($data));

        if(isset($data)) {
            Category::where('id', $id)->delete();
            return response()->json(['status' => true, 'message' => "delete success"], 200);
        }

        return response()->json(['status' => false, 'message' => "There is no category"], 200);

        
    }

    // get contact data
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
