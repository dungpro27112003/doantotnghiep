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
        return Menu::orderbyDesc('id')
        ->get();
    }

    public function create($request){
        try{
            $data = new Menu();
            $data->name = (string)$request->input('name');
                // 'parent_id' =>(int)$request->input('parent_id'),
            $data->description = (string)$request->input('description');
            $data->content = (string)$request->input('content');
            $data->active =(string)$request->input('active');
            $link = $request->image;
            if($link != null){
                $realPath = $link->getRealPath();
                $name = $link->getClientOriginalName();
                $newName = current(explode('.',$name));
                $pathFull = 'storage/upload/'.$newName.'-'.date('Y-m-d').'.'.$link->getClientOriginalExtension();
                move_uploaded_file($realPath,$pathFull);
                $data->menu_image = $pathFull;
            }
            $data->save();
            Session::flash('success','Tạo thành công');
        }catch(Exception $err){
            Session::flash('error',$err->getMessage());
        }
        return true;
    }
    public function destroy($request){
        $id = $request->id;

        $menu = Menu::where('id',$id)->first();
        if($menu){
            if(file_exists($menu->menu_image)){
                unlink($menu->menu_image);
            }
            return Menu::where('id',$id)->delete();
        }
        return false;
    }
    public function update($menu,$request)
    {
        // if($request->input('parent_id')!=$menu->id){
        //     $menu->parent_id = (int)$request->input('parent_id');
        // }
        $data = Menu::find($menu);
        if($data){
            $data->name = $request->name;
            $data->description = $request->description;
            $data->content = $request->content;
            $link = $request->image;
            if($link != null){
                $realPath = $link->getRealPath();
                $name = $link->getClientOriginalName();
                $newName = current(explode('.',$name));
                if(file_exists($data->menu_image)){
                    unlink($data->menu_image);
                }
                $pathFull = 'storage/upload/'.$newName.'-'.date('Y-m-d').'.'.$link->getClientOriginalExtension();
                move_uploaded_file($realPath,$pathFull);
                $data->menu_image = $pathFull;
            }
            $data->active = $request->active;
            $data->save();
            return true;
        }
        return false;
        
    }

    public function getID($id){
        return Menu::where('id',$id)->where('active',1)->firstOrFail();
    }
    
    public function getProduct($menu,$request){
        $query = $menu->products()
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