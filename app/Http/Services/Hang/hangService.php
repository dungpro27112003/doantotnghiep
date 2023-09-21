<?php

namespace App\Http\Services\Hang;

use App\Models\Hang;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class hangService{
    public function create($request){
        try{
            Hang::create([
                'tenhang' =>(string)$request->input('name')
            ]);
            Session::flash('success','Tạo thành công');
        }catch(Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    public function getAll(){
        return Hang::orderbyDesc('id')->paginate(10);
    }

    // public function getParent($id){
    //     return Hang::where('id',$id)->first();
    // }
    
    public function update($request,$hang){
        try{
            $hang->tenhang = (string)$request->input('name');
            $hang->save();
            Session::flash('success','Cập nhật hãng thành công');
        }catch(Exception $err){
            Session::flash('errror','Có lỗi vui lòng thử lại');
            Log::info($err->getMessage());
            return false;
        }
        return true;
    }
    
    public function destroy($request){
        $hang = Hang::where('id',$request->input('id'))->first();
        if($hang){
            $hang->delete();
            return true;
        }
        return false;
    }
}