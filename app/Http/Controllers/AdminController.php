<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function index()
    {
     
    	return view('admin.index');

    }

     public function verify(Request $request)
    {

        // return $request;
        $u = DB::table('registration') 
            ->where('username', $request->username)
            ->where('password', $request->password)
            ->where('type', '=', 'admin')
            ->first();
        // dd($u);
    	if(!$u)
    	{
            $request->session()->flash('message', 'Invalid Admin or password');
    		return redirect('/admin');
    	}
    	else
    	{
               
            $request->session()->put('admin', $u);
    		return redirect('/registration');
    		
    	}
    }
}
