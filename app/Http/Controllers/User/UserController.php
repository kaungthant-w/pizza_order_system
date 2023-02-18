<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home() {
        $pizza =Product::orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id', Auth::user()->id)->get();
        return view('user.main.home', compact('pizza', 'category', 'cart'));
    }

    // change Password Page
    public function changePasswordPage() {
        return view('user.password.change');
    }

    //change password
    public function changePassword(Request $request) {

        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password; // hash value
        if(Hash::check($request->oldPassword, $dbHashValue)) {
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id', Auth::user()->id)->update($data);
            
            // Auth::logout();
            return back()->with(['changeSuccess'=>'password ပြောင်းလဲခြင်း အောင်မြင်ပါပြီ...']);

        }

        return back()->with(['notMatch'=>'Password မူရင်း နှင့် တူညီမှု မရှိပါ။ နောက်တစ်ကြိမ် ထပ်မံကြိုးစားကြည့်ပါ!']);
    }

    // user account change page
    public function accountChangePage() {
        return view('user.profile.account');
    }

    // filer pizza
    public function filter($categoryId) {
        // dd($categoryId);
        $pizza = Product::where('category_id', $categoryId)->orderBy('created_at', 'desc') -> get();
        $category = Category::get();
        return view('user.main.home', compact('pizza', 'category'));
    }

    //user account change
    public function accountChange($id, Request $request) {
        $this -> accountValidationCheck($request);
        $data = $this->getUserData($request);

        // for image 
        if($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null) {
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        
        User::where('id', $id)->update($data);
        return back()->with(['updateSuccess'=>'User Account Updated..']);
    }

    //direct pizza details
    public function pizzaDetails($pizzaId) {
        $pizza = Product::where('id', $pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details', compact('pizza', 'pizzaList'));
    }

    // cart list
    public function cartList() {
        $cartList = Cart::select('carts.*','products.name as pizza_name', 'products.price as pizza_price')
                    ->leftJoin('products', 'products.id', 'carts.product_id')
                    ->where('user_id', Auth::user()->id)
                    ->get();
                    // dd($cartList->toArray());
        $totalPrice = 0;
        foreach($cartList as $c) {
            $totalPrice += $c->pizza_price * $c->qty;
        }            
                    
        return view('user.main.cart', compact('cartList', 'totalPrice'));
    }

    // request user data 
    private function getUserData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }

    //account validation check
    private function accountValidationCheck($request) {
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,jpeg,webp|file',
            'address' => 'required',
        ], [
            'name.required' => 'name ထည့်ရန်',
            'email.required' => 'email ထည့်ရန်',
            'gender.required' => 'gender ရွေးရန်',
            'phone.required' => 'phone နံပါတ် ထည့်ရန်',
            'address.required' => 'address ထည့်ရန်',
        ])->validate();
    }
    

    // password validation check
    private function passwordValidationCheck($request) {
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|same:newPassword',
            
        ], [
            'oldPassword.required' => 'password မူရင်း ထည့်ရန်',
            'oldPassword.max' => 'password မူရင်း ၁၀ လုံးထက် များအောင် မထည့်ရန်',
            'newPassword.required' => 'password အသစ်ပြောင်းရန်',
            'confirmPassword.required' => 'အပေါ်က password အသစ်ပုံစံအတိုင်း တူအောင်ထည့်ရန်',
            'oldPassword.min' => 'password မူရင်း အနည်းဆုံး ၆ လုံးပြည့်အောင် ထည့်ရန်',
            'newPassword.min' => 'password အသစ် အနည်းဆုံး ၆ လုံးပြည့်အောင် ထည့်ရန်',
            'newPassword.max' => 'password အသစ် ၁၀ လုံးထက် များအောင် မထည့်ရန်',
            'confirmPassword.min' => 'အပေါ်က password အသစ်ပုံစံအတိုင်း အနည်းဆုံး ၆ လုံးပြည့်အောင် ထည့်ရန်',

        ])->validate();
    }
}
