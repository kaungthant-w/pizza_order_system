<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Termwind\Components\Hr;

class AdminController extends Controller
{

    //change password
    public function changePassword(Request $request) {
        // dd($request->all());
        // 1. all field must be fill 
        // 2. new password & confirm password length must be greater than 6
        // 3. new password & confirm password must same 
        // 4. client old password must be same with db password

        $this->passwordValidationCheck($request);
        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password; // hash value
        if(Hash::check($request->oldPassword, $dbHashValue)) {
            $data = [
                'password' => Hash::make($request->newPassword)
            ];
            User::where('id', Auth::user()->id)->update($data);
            
            // Auth::logout();
            // return redirect()->route('category#list');
            return back()->with(['changeSuccess'=>'password ပြောင်းလဲခြင်း အောင်မြင်ပါပြီ...']);

        }

        return back()->with(['notMatch'=>'Password မူရင်း နှင့် တူညီမှု မရှိပါ။ နောက်တစ်ကြိမ် ထပ်မံကြိုးစားကြည့်ပါ!']);
    }

    //change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }
      
    //direct admin detail page
    public function details() {
        return view('admin.account.details');
    }

    //direct admin profile page
    public function edit() {
        return view('admin.account.edit');
    }

    //update account
    public function update($id,Request $request) {
        // dd($id, $request-> all());
        $this -> accountValidationCheck($request);
        $data = $this->getUserData($request);

        // for image 
        if($request->hasFile('image')) {
            // 1 old image name | check => delete | store
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
        return redirect()->route('admin#details')->with(['updateSuccess'=>'Admin Account Updated..']);
    }

    //admin list
    public function list() {
        $admin = User::when(request('key'), function($query){
                $query->orWhere('name', 'like', '%'.request('key').'%')
                      ->orWhere('email', 'like', '%'.request('key').'%')
                      ->orWhere('gender', 'like', '%'.request('key').'%')
                      ->orWhere('phone', 'like', '%'.request('key').'%')
                      ->orWhere('address', 'like', '%'.request('key').'%');
                })
                ->where('role', 'admin')
                ->paginate(5);
        $admin->appends(request()->all());
        return view('admin.account.list', compact('admin'));
    }

    //admin delete
    public function delete($id) {
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess'=>'Admin Account Deleted...']);
    }

    //change role
    public function changeRole($id) {
        $account = User::where('id', $id) -> first();
        return view('admin.account.changeRole', compact('account'));
    }

    // change 
    public function change($id, Request $request) {
        $data = $this->requestUserData($request);
        User::where('id', $id)->update($data);
        return redirect()->route('admin#list');
    }

    //request user data
    public function requestUserData($request) {
        return [
            'role' => $request->role
        ];
    }

    //ajax change role
    public function ajaxChangeRole(Request $request) {
        logger($request->all());
        $adminChange = User::where('id', $request->roleId)->update([
            'role' => $request->role
        ]);

        return response()->json($adminChange, 200);
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
