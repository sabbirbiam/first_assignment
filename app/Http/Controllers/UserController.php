<?php

namespace App\Http\Controllers;

use App\Models\Stories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // return view('stories.index');
        $stories = Stories::with(['user', 'comment'])->get();
        return view('user.stories', ['stories' => $stories]);
        return response()->json($stories);
    }

    public function create()
    {
        // dd("sabbir");
        return view('user.create');
    }

    public function store(Request $request)
    {
        if (!($request->session()->has('register')) && $request->session()->get('register')->id) {
            return "stop no session";
        }
        //  $data = Session::get('register');
        $data['title'] = $request->title ?? "";
        $data['story'] = $request->story ?? "";
        $data['tags'] = $request->tags ?? "";
        $data['section'] = $request->section ?? "";
        $data['storyimage'] = $request->storyimage ?? "";
        $data['storycaption'] = $request->storycaption ?? "";
        $data['blocked'] = 1;
        $data['user_id'] = $request->session()->get('register')->id ?? null;

        $success = Stories::create($data);
        return redirect('/user/stories');
    }
}
