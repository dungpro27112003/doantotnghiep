<?php

namespace App\Http\Controllers;

use App\Http\Services\CartService;
use App\Models\CouponModel;
use App\Models\PriceDiscountModel;
use App\Models\UserCouponModel;
use App\Models\UserCustomerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(Request $request){
        $id = $request->id;
        $quantity = $request->quantity;
        $result = $this->cartService->create($id,$quantity);
        
        if($result === false){
            return redirect()->back();
        }
        // return redirect('/carts');
    }

    public function show(){
        $products = $this->cartService->getProduct();
        if(!empty(session('user_customer_id'))){
            $userCustomer = UserCustomerModel::where('user_customer_id',session('user_customer_id'))->first();
        }else{
            return redirect()->route('login');
        }
        return view('carts.list',[
            'title' =>'Giỏ hàng',
            'carts'=> Session::get('carts'),
            'products'=>$products,
            'userCustomer'=>$userCustomer,
        ]);
    }

    public function update(Request $request){
        $this->cartService->update($request);
        return redirect('/carts');
    }

    public function remove(Request $request){
        $this->cartService->remove($request);
        return redirect('/carts');
    }

    public function addCart(Request $request ){
        $rule=[
            'order_name.required',
            'order_phone.required',
            'order_phone.numeric',
            'order_address.required',
            'order_email.email',
            'order_email.required',
        ];
        $message=[
            'order_name.required'=>'Tên bắt buộc phải nhập',
            'order_phone.required'=>'Số điện thoại bắt buộc nhập',
            'order_phone.numeric'=>'Số điện thoại không đúng định dạng',
            'order_address.required'=>'Địa chỉ nhà bắt buộc phải nhập',
            'order_email.email'=>'Email không đúng định dạng',
            'order_email.required'=>'Email bắt buộc phải nhập',
        ];
        $request->validate($rule,$message);
        $coupon = null;
        if(!empty(session('user_customer_id'))){

            $userid = session('user_customer_id');
            if(!empty( session('coupon'))){
                $couponcode = session('coupon')[$userid]['coupon_code'];
                $coupon = CouponModel::where('coupon_code',$couponcode)->first();
                $userCustomer = UserCustomerModel::find($userid);
                $userCustomer->coupon()->sync($coupon->coupon_id);
            }
        }
        $this->cartService->addCart($request,$coupon);
        return redirect()->back();
    }

    // Coupon
    function Coupon(Request $request){
        $coupon = CouponModel::where('coupon_code',$request->coupon)->first();
        if(!empty(session('user_customer_id'))){
            if(!empty($coupon)){
                $userid = session('user_customer_id');
                $sessionCoupon = session('coupon',[]);
                $usercoupon = UserCouponModel::where('user_customer_id',$userid)->where('coupon_id',$coupon->coupon_id)->first();
                if(empty($usercoupon)){
                    if($coupon->coupon_quantity > 0){
                        if(isset($sessionCoupon[$userid])){
                            if( $sessionCoupon[$userid]['coupon_code'] == $request->coupon ){
                                session()->flash('msgcode','Mã code chỉ được dùng một lần');
                            }else{
                                session()->forget('coupon');
                                $sessionCoupon[$userid] = [
                                    'coupon_code'=>$coupon->coupon_code,
                                    'coupon_quantity'=>$coupon->coupon_quantity,
                                    'coupon_discount'=>$coupon->coupon_discount,
                                ];
                            }
                        }else{
                            $sessionCoupon[$userid] = [
                                'coupon_code'=>$coupon->coupon_code,
                                'coupon_quantity'=>$coupon->coupon_quantity,
                                'coupon_discount'=>$coupon->coupon_discount,
                            ];
                        }
                    }else{
                        session()->forget('coupon');
                        return session()->flash('msg','Mã giảm giá đã hết');
                    }
                }else{
                    return session()->flash('msg','Mã giảm giá đã được sử dụng cho tài khoản này');
                }
                session()->put('coupon',$sessionCoupon);
                return true;
            }else{
                session()->forget('coupon');
                return session()->flash('msg','Coupon không tồn tại');
            }
        }
    }
}
