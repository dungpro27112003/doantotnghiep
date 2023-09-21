<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Hang\hangService;
use App\Models\Hang;
use Illuminate\Http\Request;

class HangController extends Controller
{
    protected $hangService;

    public function __construct(hangService $hangService){
        $this->hangService = $hangService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.hang.list',[
            'title'=>'Danh sách Slider mới nhất',
            'hangs'=>$this->hangService->getAll(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.hang.add',[
            'title' =>'Thêm danh hãng',
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateFormRequest $request){
        $this->hangService->create($request);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     return view('admin.hang.edit',[
    //         'title'=>'Chỉnh sửa Hãng',
    //         'hangs'=>$this->hangService->getParent($id),
    //     ]);
    // }
    public function show(Hang $hang)
    {
        return view('admin.hang.edit',[
            'title'=>'Chỉnh sửa Hãng',
            'hangs'=>$hang,
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
    public function update(Request $request, Hang $hang)
    {
        $result = $this->hangService->update($request,$hang);
        if($result){
            return redirect('admin/hang/list');
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
        $result = $this->hangService->destroy($request);
        if($result){
            return response()->json([
                'error'=>false,
                'message' =>'Xoá thành công Silder'
            ]);
        }
        return response()->json([
            'error'=>true,
        ]);
    }
}
