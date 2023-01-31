<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Termwind\Components\Hr;

class AuthController extends Controller
{
    //direct login page
    public function loginPage() {
        return view('login');
    }

    //direct register page
    public function registerPage() {
        return view('register');
    }

    //direct dashboard
    public function dashboard() {
        if(Auth::user()->role == 'admin') {
            return redirect()->route("category#list");
        } else {
            return redirect()->route("user#home");
        }
    }

    //change password page
    public function changePasswordPage(){
        return view('admin.password.change');
    }

    //change password
    public function changePassword(Request $request) {
        // dd($request->all());
        // 1. all field must be fill 
        // 2. new password & confirm password length must be greater than 6
        // 3. new password & confirm password must same 
        // 4. client old password must be same with db password

        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbPassword = $user->password;
        $dbHashValue = $user->password; // hash value
        if(Hash::check($request->oldPassword, $dbHashValue)) {
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id', Auth::user()->id)->update($data);
            
            Auth::logout();
            return redirect()->route("auth#loginPage");
        }

        return back()->with(['notMatch'=>'The old password not match. try Again!']);
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
            'confirmPassword.same' => 'Password အသစ်နှင့် တူညီခြင်းမရှိသဖြင့်  နောက်တကြိမ် ကြိုးစားပါ။'

        ])->validate();
    }
}
