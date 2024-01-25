<?php

namespace App\Http\Services;

use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\CouponModel;
use App\Models\Customer;
use App\Models\OrderModel;
use App\Models\PriceDiscountModel;
use App\Models\Product;
use App\Models\UserCustomerModel;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function create($id , $quantity)
    {
        $qty = $quantity;
        $product_id = $id;

        if ($qty <= 0 || $product_id <= 0) {
            Session::flash('error', 'Số lượng hoặc sản phẩm không chính xác');
            return false;
        }

        $carts = Session::get('carts');

        if (is_null($carts)) {
            Session::put('carts', [
                $product_id =>  $qty 
            ]);
            return true;
        }

        $exists = Arr::exists($carts, $product_id);

        if ($exists) {

            $carts[$product_id] = $carts[$product_id] + $qty;

            Session::put('carts', $carts);
            return true;
        }

        $carts[$product_id] = $qty;

        Session::put('carts', $carts);

        return true;
    }

    public function getProduct()
    {
        $carts = Session::get('carts');
        if (is_null($carts)) {
            return [];
        }
        $productID = array_keys($carts);
        return Product::select('id', 'name', 'price', 'thumb')->with('tbl_price_dicount')
            ->where('active', 1)
            ->whereIn('id', $productID)
            ->get();
    }

    public function update($request)
    {
        
        
        $carts = Session::get('carts');
        
        foreach ($carts as $key => $quantity) {
            if ($quantity == 0) {
                unset($carts[$key]);
            } else {
                $numProducts = $request->input('num_product_'.$key);
                $carts[$key] = (int)$numProducts;
            }
        }
        Session::put('carts', $carts);
        return true;
    }

    public function remove($request)
    {
        if(!empty($request->id)){
            $carts = Session::get('carts');
            unset($carts[$request->id]);
            Session::put('carts', $carts);
        }
        return true;
    }

    public function addCart($request,$coupon)
    {
        DB::beginTransaction();
        try {
                $carts = session()->get('carts');
                if ($carts == null) {
                    return false;
                }
                $order = new OrderModel();
                $order->order_name = $request->order_name;
                $order->order_phone = $request->order_phone;
                $order->order_address = $request->order_address;
                $order->order_email = $request->order_email;
                $order->user_customer_id = $request->user_customer_id;
                $order->coupon_id = $coupon!=null?$coupon->coupon_id:null;
                $order->created_at=now();
                $order->save();

                $slcOrder = OrderModel::orderBy('order_id','DESC')->first();
                $this->infoProductCart($carts,$slcOrder->order_id );
                // coupon
               
                if(!empty(session('user_customer_id'))){
                    if(!empty(session('coupon')[session('user_customer_id')])){
                        $coupon = CouponModel::where('coupon_code',session('coupon')[session('user_customer_id')]['coupon_code'])->update([
                            'coupon_quantity'=>(int)session('coupon')[session('user_customer_id')]['coupon_quantity']-1,
                        ]);
                        session()->forget('coupon');
                    }
                }
                // dd('ok');

                Session::flash('success', 'Đặt hàng thành công');
                
                // SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(2));
                
                Session::forget('carts');
                DB::commit();
                    
        } catch (Exception $err) {
            DB::rollBack();
            Session::flash('error', 'Đặt hàng lỗi vui lòng thử lại');
            return false;
        }
        return true;
    }

    public function infoProductCart($carts, $order_id)
    {
        $productID = array_keys($carts);
        $products = Product::with('tbl_price_dicount')
            ->where('active', 1)
            ->whereIn('id', $productID)
            ->get();
        $order = OrderModel::with('coupon')->find($order_id);
       
            $data = [];
            $total = 0;
            foreach ($products as $product) {
                if($product->product_quantity>0){
                    $product->update([
                        'product_quantity'=>$product->product_quantity-$carts[$product->id],
                    ]);
                }
                $price = $product->price ;
                if(!empty($product->tbl_price_dicount && date("Y/m/d") != str_replace('-','/',$product->tbl_price_dicount->end_at))){
                    $percent = $product->tbl_price_dicount->percent_price/100;
                    $discount = $price * $percent;
                    $result = $price - $discount;
                    if (session('coupon')!=null ) {
                        # code...
                        $priceEnd =  $result * $carts[$product->id]-session('coupon')[session('user_customer_id')]['coupon_discount'];
                        $total += $priceEnd;
                        
                    }else{
                        $priceEnd = $result * $carts[$product->id];
                        $total += $priceEnd;
                    }
                } else {
                    if (session('coupon')!=null) {
                        # code...
                        $priceEnd = $price * $carts[$product->id]-session('coupon')[session('user_customer_id')]['coupon_discount'];
                        $total += $priceEnd;
                    } else{
                        # code...
                        $priceEnd = $price * $carts[$product->id];
                        $total += $priceEnd;
                    }
                }
                // dd($priceEnd);
                $data[] = [
                    'order_id' => $order_id,
                    'product_id' => $product->id,
                    'pty' => $carts[$product->id],
                    'price' => $priceEnd,
                    'coupon_code'=> $order->coupon !=null ? $order->coupon->coupon_code : null,
                ];
                
            }
            Cart::insert($data);
            
    }

    public function getCustomer()
    {
        return OrderModel::orderByDesc('order_id')->paginate(15);
    }

    public function getProductForCart($id)
    {
        $carts = Cart::with('product')->where('order_id',$id)->get();
        return $carts;
        // foreach ($carts as $key => $value) {
        //     # code...
        //     return $value;
        // }
        
        // return $order->carts()->with(['product' => function ($query) {
        //     $query->select('id', 'name', 'thumb');
        // }])->get();
    }
}
