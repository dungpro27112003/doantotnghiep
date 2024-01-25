<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Products\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $productService;
    protected $menuService;

    public function __construct(ProductService $productService,MenuService $menuService){
        $this->productService = $productService;
        $this->menuService = $menuService;
    }
    
    public function index()
    {
        return view('admin.products.list',[
            'title'=>'Danh sách sản phẩm',
            'products'=>$this->productService->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.add',[
            'title' =>'Thêm sản phẩm mới',
            'menus'=>$this->productService->getMenu(),
            'hang'=>$this->productService->getHang(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $this->productService->insert($request);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.edit',[
            'title'=>'Chỉnh sửa sản phẩm',
            'product'=>$product,
            'menus'=>$this->productService->getMenu(),
            'hang'=>$this->productService->getHang(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $result=$this->productService->update($request,$id);
        if($result){
            return redirect('admin/products/list');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $result = $this->productService->delete($request);
        if($result){
            return response()->json([
                'error'=>false,
                'message'=>'Xoá thành công sản phẩm',
            ]);
        }
        return response()->json(['error'=>true]);
    }
}
