<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\RoleMode;
use App\Models\UserCustomerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        return view('admin.users.login',[
            'title'=>'Đăng nhập hệ thông',
        ]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'email' => 'required|email:filter',
            'password' => 'required',
        ]);
        $userCustomer = UserCustomerModel::where('user_customer_email',$request->input('email'))
            ->where('user_customer_password',md5($request->input('password')))
            ->first();
        if($userCustomer != null){
            if($userCustomer->has_role(1) || $userCustomer->has_role(2)){
                session()->put('user', $userCustomer);
                return redirect()->route('indexAdmin');
            }else{
                Session::flash('error','Tài khoản không có quyển truy cập');
                return redirect()->back();
            }
        }else{
            Session::flash('error','Email hoặc mật khẩu không đúng');
            return redirect()->back();
        }
    }
    public function logout(){
        session()->forget('user');
        return redirect()->route('loginAdmin');
    }
}
