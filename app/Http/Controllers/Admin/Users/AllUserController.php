<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\UserCustomerModel;
use Illuminate\Http\Request;

class AllUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = "Danh sách tài khoản";
        $usercustomer = UserCustomerModel::orderBy('user_customer_id',"DESC")->paginate(10);
        return view('admin.users.alluser',compact('title','usercustomer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $usercustomer = UserCustomerModel::where('user_customer_email',$request->email)->first();
        $usercustomer->role()->detach();
        if(!empty($request->chk_admin)){
            $usercustomer->role()->attach(1);
        }
        if(!empty($request->chk_nhanvien)){
            $usercustomer->role()->attach(2);
        }
        if(!empty($request->chk_customer)){
            $usercustomer->role()->attach(3);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
