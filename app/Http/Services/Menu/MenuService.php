<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;


class MenuService
{
    public function getParent(){
        return Menu::where('id',0)->get();
    }

    public function getAll(){
        return Menu::orderbyDesc('id')->paginate(20);
    }

    public function show(){
        return Menu::select('name','id')
        //->where('parent_id',0)
        ->orderbyDesc('id')
        ->get();
    }

    public function create($request){
        try{
            Menu::create([
                'name' =>(string)$request->input('name'),
                // 'parent_id' =>(int)$request->input('parent_id'),
                'description' =>(string)$request->input('description'),
                'content' =>(string)$request->input('content'),
                'active' =>(string)$request->input('active'),
            ]);
            Session::flash('success','Tạo thành công');
        }catch(Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }
    public function destroy($request){
        $id = (int)$request->input('id');

        $menu = Menu::where('id',$id)->first();
        if($menu){
            return Menu::where('id',$id)->orWhere('parent_id',$id)->delete();
        }
        return false;
    }
    public function update($menu,$request):bool
    {
        if($request->input('parent_id')!=$menu->id){
            $menu->parent_id = (int)$request->input('parent_id');
        }

        $menu->name = (string)$request->input('name');
        $menu->description = (string)$request->input('description');
        $menu->content = (string)$request->input('content');
        $menu->active = (string)$request->input('active');
        $menu->save();
        Session::flash('success','Cập nhật thành công');
        return true;
    }

    public function getID($id){
        return Menu::where('id',$id)->where('active',1)->firstOrFail();
    }
    
    public function getProduct($menu,$request){
        $query = $menu->products()
        ->select('id','name','price','price_sale','thumb')
        ->where('active',1);
        
        $searchKeyword = $request->input('search');

        if($request->input('price')=='asc'||$request->input('price')=='desc'){
            $query->orderBy('price',$request->input('price'));
        }elseif($request->input('price')=='0-5000000'){
            $query->whereBetween('price',[0,5000000]);
        }elseif($request->input('price')=='5000000-10000000'){
            $query->whereBetween('price',[5000000,10000000]);
        }elseif($request->input('price')=='10000000-up'){
            $query->where('price','>=','10000000')
            ->orderBy('price','asc');
        }

        // Xử lý tìm kiếm sản phẩm dựa trên $searchKeyword
        if (!empty($searchKeyword)) {
            $query->where('name', 'like', '%' . $searchKeyword . '%');
        }

        return $query->orderByDesc('id')->paginate(8)->withQueryString();
    }

}