<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CartService;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\OrderModel;
use App\Models\PriceDiscountModel;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    public function index(){
        return view('admin.carts.customer',[
            'title'=>'Danh sách đơn đặt hàng',
            'order'=>$this->cartService->getCustomer()
        ]);
    }
    public function show($id){
        $order = OrderModel::where('order_id',$id)->first();
        $carts = $this->cartService->getProductForCart($id);
        // $product = Product::where('id',$carts->product_id)->get();
        return view('admin.carts.detail',[
            'title'=>'Chi tiết đơn hàng'.$order->order_name,
            'order'=>$order,
            'carts' => $carts,
        ]);
    }
    public function delete(Request $request){
        DB::beginTransaction();
        try {
            //code...
            Cart::where('order_id',$request->id)->delete();
            OrderModel::where('order_id',$request->id)->delete();
            DB::commit();
            session()->flash('msg','Xóa thành công');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }

    }
}
