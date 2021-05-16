<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $getproduct = Product::where('user_id', Auth::id())->get();
        return view('user.index', compact('getproduct'));
    }
}
