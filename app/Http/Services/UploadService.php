<?php

namespace App\Http\Services;
use FFI\Exception;


class UploadService{
    public function store($request){
        if($request->hasFile('file')){
            try{
                $pathReal = $request->file('file')->getRealPath();
                $name = $request->file('file')->getClientOriginalName();
                $path='storage/uploads/'.date("Y/m/d");
                if(!is_dir($path)){
                    mkdir($path,0777,true);
                }
                $pathFull = '/'.$path.'/'.$name;
                move_uploaded_file($pathReal,$path.'/'.$name);
                return $pathFull;
            }catch(Exception $error){
                return false;
            }   
        }
        return false;
            
    }
}