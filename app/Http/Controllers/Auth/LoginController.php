<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
   
    use AuthenticatesUsers;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){

        $fieldData = $request->all();

        $this->validate($request,[
            'companyid' => 'required',
            'password' => 'required',
        ],[ 'companyid.required' => 'Company ID Is Required.']);

        if(auth()->attempt(array('company_id' => $fieldData['companyid'], 'password' => $fieldData['password']))){
            if(auth()->user()->role_id == 1){
                return redirect('admin/home');
            } elseif(auth()->user()->role_id == 2){
                return redirect('user/home');
            } 
        } else {
            return redirect()->route('login')->with('error', 'Company Id and Password Dose Not Match!!');
        }

    }
}