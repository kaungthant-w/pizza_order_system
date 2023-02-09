<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home() {
        $pizza =Product::orderBy('created_at', 'desc')->get();
        $category = Category::get();
        return view('user.main.home', compact('pizza', 'category'));
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
