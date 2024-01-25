<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SigninRequest;
use App\Http\Requests\SignupRequest;
use App\Models\Cart;
use App\Models\FavouriteModel;
use App\Models\OrderModel;
use App\Models\PriceDiscountModel;
use App\Models\User;
use App\Models\UserCustomerModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function showlogin(){
        return view('User.Login');
    }
    public function logout(){
        session()->forget('user_customer_id');
        return redirect()->route('trangchu');
    }
    public function signin(SigninRequest $request){
        $userCustomer = UserCustomerModel::where('user_customer_email',$request->form_email_signin)
        ->where('user_customer_password',md5($request->form_password_signin))->first();
        if($userCustomer != null){
            if($userCustomer->has_role(2) || $userCustomer->has_role(3)){
                session()->put('user_customer_id',$userCustomer->user_customer_id);
                return redirect()->route('trangchu');
            }
        }else{
            return back()->with('errorlogin','Tài khoản hoặc mật khẩu không đúng');
        }
    }
    public function signup(SignupRequest $request){
        if($request->form_password == $request->form_repassword){
            UserCustomerModel::create([
                'user_customer_name'=>$request->form_name,
                'user_customer_email'=>$request->form_email,
                'user_customer_password'=>md5($request->form_password) ,
            ]);
            $userCustomer = UserCustomerModel::select('user_customer_id')->orderBy('user_customer_id','DESC')->first();
            $userCustomer->role()->sync(3);
            // dd($userCustomer);
            session()->put('user_customer_id',$userCustomer->user_customer_id);
            return redirect()->route('trangchu');
        }else{
            return back()->with('error','Vui lòng kiểm tra lại thông tin');
        }
    }

    // page option user
    public function manager_user($id) {
        $title = 'Quản lý tài khoản';
        if(!empty(session('user_customer_id'))){
            $user = UserCustomerModel::where('user_customer_id',session('user_customer_id'))->first();
        }
        return view('option_user.taikhoan',compact('title','user','id'));
    }
    function overview() {
        $html = '';
        if(!empty(session('user_customer_id'))){
            $user = UserCustomerModel::where('user_customer_id',session('user_customer_id'))->get();
        }
        foreach ($user as $key => $item) {
            # code...
            $html .= '
            <div class="" style="margin: 20px 0">
                <h4>Tổng quan</h4>
                <div class="" style="text-align: center; margin-top: 20px">
                    <div class="row" style="display: flex; ">
                            <div class="col">
                                <div class="">Tên đăng nhập</div>
                                <div class="">
                                    <b>
                                        '.$item->user_customer_name.'
                                    </b>
                                </div>
                            </div>
                            <div class="col">
                                <div class="">Email</div>
                                <div class="">
                                    <b>
                                        '.$item->user_customer_email.'
                                    </b>
                                </div>
                            </div>
                            <div class="col">
                                <div class="">Ngày tham gia</div>
                                <div class="">
                                    <b>
                                        '. $item->created_at.'
                                    </b>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            ';
        }
        return $html;
    }
    function history_order(){
        $html = '';
        if(!empty(session('user_customer_id'))){
            $user = UserCustomerModel::where('user_customer_id',session('user_customer_id'))->first();
            $order = OrderModel::where('user_customer_id',$user->user_customer_id)->get();
        }
        # code...

            $html .= '
            <div class="" style="margin: 20px 0">
                <h4>Lịch sử đơn hàng</h4>
                <p>Hiển thị thông tin các sản phẩm bạn đã mua hàng</p>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Sản phẩms</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng tiền</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>';
                    $i = 1;
                    foreach ($order as $key => $value) {
                        # code...
                        $cart = Cart::with('product','tbl_order')->where('order_id',$value->order_id)
                        ->get();

                        $html.=' 
                            <tr>
                                
                                ';
                            foreach ($cart as $key => $item) {
                                $cartcount = Cart::where('order_id',$item->order_id)->count('product_id');
                                if($cartcount == 1){
                                    $html.=' 
                                        <td style="text-align:center;">'.$value->created_at.'</td>
                                        ';
                                }else{
                                    if($key == 0){
                                        $html.=' 
                                            <td rowspan="'.$cartcount.'" style="padding: 26px 0px ; text-align:center;">'.$value->created_at.'</td>
                                            ';
                                    }
                                }
                                if($key == 0){
                                    $html.='
                                        <td>'.$cart[$key]->product->name.'</td>
                                        <td>'.$cart[$key]->pty.'</td>
                                        <td>'.$cart[$key]->price.'</td>
                                    ';
                                    
                                    if($cartcount>1){
                                        $html.='
                                            <td style="text-align:center; padding: 26px 0px ;"  " rowspan="'.$cartcount.'"><b><a href="#" class="show_detail_order"   onclick="clickDetail('.$cart[$key]->order_id.')"  >chi tiết</a></b</td>
                                        </tr>
                                        ';
                                    }else{
                                        $html.='
                                            <td style="text-align:center;"  "><b><a href="#" class="show_detail_order"   onclick="clickDetail('.$cart[$key]->order_id.')"  >chi tiết</a></b</td>
                                        </tr>
                                        ';
                                    }
                                }else
                                if($key > 0){
                                    $html.='
                                        <tr>
                                            <td>'.$cart[$key]->product->name.'</td>
                                            <td>'.$cart[$key]->pty.'</td>
                                            <td>'.$cart[$key]->price.'</td>
                                        </tr>
                                    ';
                                }
                            }
                    }

                    $html.='</tbody>
                </table>
            </div>
            ';
        return $html;
    }
    function detail_order(Request $request) {
        $html = '';
        if(!empty($request->id)){
            $cart = Cart::with('product','tbl_order')->where('order_id',$request->id)->get();
            $html.='
            <div class="" style="margin: 20px 0">
                <h4>Chi tiết đơn hàng</h4>
                <p>Hiển thị thông tin các sản phẩm bạn đã mua hàng</p>
                <hr>
                <div class="" style="text-align: center; margin-top: 20px">
                    <div class="row" >
                            <div class="col">
                                <div class=""><b>Thông tin đơn hàng</b></div>
                                <div class="">';
                                foreach ($cart as $key => $value) {
                                    # code...
                                    if($key == 0){
                                        $html.='
                                            <p>Ngày tạo: '.$cart[$key]->tbl_order->created_at.'</p>
                                            <p>Trạng thái đơn hàng: none</p>
                                            <p>Người nhận: '.$cart[$key]->tbl_order->order_email.'</p>
                                        ';
                                    }
                                }
                            $html.='</div>
                            </div>
                            <div class="col">
                                <div class=""><b>Gía trị đơn hàng</b></div>
                                <div class="">';
                                $total = 0;
                                foreach ($cart as $key => $value) {
                                    # code...
                                    if($key == 0){
                                        $total += $value->price;
                                    }else{
                                        $total +=$cart[$key++]->price;
                                    }
                                    
                                }
                                $html.='
                                    <p>Tổng tiền: '.number_format($total).'</p>
                                ';
                            $html.='</div>
                            </div>
                    </div>
                    <hr>
                    <div class="container_product">';
                    foreach ($cart as $key => $value) {
                        $html.='<div class="ta ec Sf Je" style="display:flex;">
                            <div class="kg Ub" style="width:204px">
                                <a target="_blank" rel="noreferrer" class="lf gf ff ra" tabindex="-1">';
                                    $html.='
                                        <img style="object-fit: contain;height: 112px;" src="'.$value->product->thumb.'" loading="lazy" class="xc" alt="">
                                    ';
                            $html.='</a>
                            </div>
                            <div class="sg Rd Le" style="width: 100%">
                                <div class="ta gc nc Ge" style="
                                        display: flex;
                                        width: 100%;
                                        justify-content: space-around;
                                    ">';
                                    
                                        # code...
                                        $html.='
                                        <h6 class="af pg Vb Ub Nb">
                                            <a target="_blank" rel="noreferrer">'.$value->product->name.'</a>
                                        </h6>
                                        <h6 class="kg">Số lượng: '.$value->pty.'</h6>
                                        <h6 class="jg Ud">'.$value->price.'</h6>
                                        ';
                             
                                $html.='</div>
                            </div>
                        </div>';
                    }
                    $html.='</div>
                </div>
            </div>
            ';
        }
        return $html;

    }

    function page_product_like(){
        $html = '';
        if(!empty(session('user_customer_id'))){
            $user = UserCustomerModel::where('user_customer_id',session('user_customer_id'))->first();
            $favourite = FavouriteModel::where('user_customer_id',$user->user_customer_id)->get();
        }
        $html .= '
        <div class="" style="margin: 20px 0">
            <h4>Sản phẩm yêu thích</h4>
            <p>Danh sách các sản phẩm mà bạn đã đánh dấu "yêu thích"</p>
            <hr>';
        if(count($favourite)>0){
            foreach ($favourite as $key => $value) {
                # code...
                $pricediscount = PriceDiscountModel::where('product_id',$value->product->id)->first();
                $html .='
                <div class="Oe">
                    <div class="Mf kc fg Fe dg" style="display: flex; justify-content: space-around; margin-bottom:15px;">
                        <div class="lg" style="height: auto;">
                            <a class="lf gf ff ra" href="/construction-simulator-2015">
                                <img style="width: 180px;height: 112px; object-fit:contain;" loading="lazy" src="'.$value->product->thumb.'" class="xc" alt="Construction Simulator 2015">
                            </a>
                        </div>
                        <div class="qg Kg ta ec pc Le">
                            <div class="Ce">
                                <h6>
                                    <a style="font-style: normal;font-size: 17px;color: black;" href="/construction-simulator-2015">'.$value->product->name.'</a>
                                </h6>
                                <div style="color: #6b7280;" class="he">'.$value->product->name.'</div>
                            </div>
                            <div class="ta He" style="font-size: 16px; margin-top:10px">
                                <button style="padding-right: 5px" type="button" class="btn_heart_'.$value->favourite_id.'" onclick="clickHeart('.$value->favourite_id.')" title="Xóa khỏi danh sách yêu thích">
                                    <i class="fa-solid fa-heart heart_'.$value->favourite_id.'" style="color: #dc3545"></i>
                                    <div data-ok="no_delete" style="color: #9ca3af; display:none;">Bỏ thích</div>
                                </button>
                                <button type="button" class="b" title="Thêm vào giỏ" onclick="return clickAddCart('.$value->product->id.','.$value->product->product_quantity.')">
                                    <div class="ta Ee ge Zd" style="display: flex;align-items: center;">
                                        <i class="fa-solid fa-cart-plus" style="padding-right: 5px"></i>
                                        <div>Thêm vào giỏ</div>
                                    </div>
                                </button>
                        </div>
                    </div>
                    <div class="hg ta Uf Wf ic De" style="display: flex ; align-items: center;">';
                        // <h6 style="font-size: 19px">'.number_format($value->product->price).'đ </h6>
                        if (!empty($pricediscount) && date("Y/m/d") != str_replace('-','/',$pricediscount->end_at)){
                            $price = $value->product->price;
                            $percent = $pricediscount->percent_price/100;
                            $discount = $price * $percent;
                            $total = $price - $discount;
                            $html.='<h6 style="font-size:17px;font-weight: 600">'.number_format($total).'đ</h6>
                            <div style="display: flex; align-items: center;">
                                <h6 style=" font-size:17px;font-weight: 600; text-decoration-line: line-through; color: #9ca3af;">'. number_format($value->product->price).'đ</h6>
                                <small style="font-size:14px; font-weight: 600; margin-left: 5px; background-color: #dc3545; border-radius: 7px ;color: white;
                                padding: 4px;">
                                    -'. $pricediscount->percent_price .'%
                                </small>
                            </div>';
                        }else{
                            // $html.='<h4 style="font-weight: 600">{!! App\Helpers\Helper::price($product->price) !!}đ</h4>';
                            $html.='<h6 style="font-size: 17px; font-weight: 600 ">'.number_format($value->product->price).'đ </h6>';
                        }
                    $html.='</div>
                    <div class="va We vg lc" style="    display: flex;font-size: 22px;">
                        <button type="button" onclick="clickTrashCan('.$value->favourite_id.')" class="btn_trashCan_'.$value->favourite_id.'" title="Xóa khỏi danh sách yêu thích">
                            <i class="fa-solid fa-trash-can  " style="color: #dc3545"></i>
                            <div  style="color: #dc3545; display:none;">Xóa</div>
                        </button>
                    </div>
                </div>
                ';
            }
        }else{
            $html.='
                <div class="Oe">
                    <img loading="lazy" src="https://cdn.divineshop.vn/static/4e0db8ffb1e9cac7c7bc91d497753a2c.svg" class="Ca" alt="Không có sản phẩm yêu thích">
                </div>
            ';
        }
        $html.='</div>';
        return $html;
    }
    function delete_favourite (Request $request){
        if(!empty(session('user_customer_id'))){
            $user = UserCustomerModel::where('user_customer_id',session('user_customer_id'))->first();
            FavouriteModel::where('favourite_id',$request->id)->delete();
        }
        return $this->page_product_like();
    }
}
