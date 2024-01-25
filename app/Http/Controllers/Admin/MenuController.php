<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuService;
use App\Models\Menu;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService){
        $this->menuService = $menuService;
    }

    public function create(){
        return view('admin.menu.add',[
            'title' =>'Thêm danh mục mới',
            'menus' =>$this->menuService->getParent(),
        ]);
    }
    public function store(CreateFormRequest $request){
        $this->menuService->create($request);
        return redirect()->back();
    }

    public function index(){
        return view('admin.menu.list',[
            'title'=>'Danh sách danh mục mới nhất',
            'menus'=>$this->menuService->getAll(),
        ]);
    }
    
    public function show(Menu $menu){
        return view('admin.menu.edit',[
            'title'=>'Chỉnh sửa danh mục '.$menu->name,
            'menu'=>$menu,
            'menus' =>$this->menuService->getParent(),
        ]);
    }
    
    public function update($menu,CreateFormRequest $request){
        $check = $this->menuService->update($menu,$request);
       
        // dd($check);
        if ($check) {
            # code...
            // return redirect()->route('listMenu')->with('success','Cập nhật thành công');
            return back()->with('success','Cập nhật thành công');
        }else{
            return back();
        } 
        
    }

    public function destroy(Request $request){
        $result = $this->menuService->destroy($request);
        if($result){
            return response()->json([
                'error' => false,
                'message' => 'Xoá thành công danh mục',
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }
}
