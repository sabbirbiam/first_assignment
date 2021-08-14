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
        if (!$u) {
            $request->session()->flash('message', 'Invalid Admin or password');
            return redirect('/admin');
        } else {

            $request->session()->put('admin', $u);
            return redirect('/admin/home');
            // return redirect('/registration');

        }
    }

    public function adminhome(Request $request)
    {

        if (!$request->session()->has('admin')) {
            return "stop no session";
        }

        $value =  $request->session()->get('admin');

        // dd($value);
        return view('admin.home')
            ->with('de', $value);
    }

    public function userinfo()
    {
        $userlist = DB::table('registration')
            ->where('type', '=', 'user')
            ->get();

        // return $userlist;
        return view('admin.userinfo')
            ->with('userlist', $userlist);
    }

    public function userStatus($id)
    {
        // return $request;
        // return $id;


        $stroy = DB::table('registration')
            ->where('id', $id)
            ->first();


        if ($stroy->status == 0) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }

        DB::table('registration')
            ->where('id', $id)
            ->update($data);

        return redirect('/userInfo');
    }
}
