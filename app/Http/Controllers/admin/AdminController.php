<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
        $getproduct = Product::all();
        $getusers = User::all();
        return view('admin.index',compact('getproduct','getusers'));
    }
}