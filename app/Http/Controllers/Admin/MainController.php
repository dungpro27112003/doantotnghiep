<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        return view('admin.main',[
            'title'=>'Trang quản Trị Admin'
        ]);
    }
    public function home(){
        return view('admin.home',[
            'title'=>'Home'
        ]);
    }
}
