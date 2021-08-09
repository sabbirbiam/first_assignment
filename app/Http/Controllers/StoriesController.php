<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Stories;
use Illuminate\Http\Request;

class StoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $stories = Stories::with(['user'])->get();
        return response()->json($stories);
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
        // return $request;

        if (!isset($request->user_id)) {
            return response()->json(array(
                'code' => 409,
                'status' => 0,
                'message' => 'User Id is mandatory'
            ));
        }

        $user = Registration::where('id', $request->user_id)->first();

        if (!isset($user->id)) {
            return response()->json(array(
                'code' => 409,
                'status' => 0,
                'message' => 'User Not Found'
            ));
        }

        $data['title'] = $request->title ?? "";
        $data['story'] = $request->story ?? "";
        $data['tags'] = $request->tags ?? "";
        $data['user_id'] = $request->user_id ?? null;

        $success = Stories::create($data);

        if ($success) {
            return response()->json(array(
                'id' => $success->id,
                'status' => 1,
                'message' => 'Stories Save Succefully'
            ));
        } else {
            return response()->json(array(
                'id' => 0, 'status' => 0,
                'message' => 'Stories Failed to save'
            ));
        }
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

        $stories = Stories::find($id);

        if ($stories) {
            $response = [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data available'
            ];

            return response()->json([
                'data' => $stories,
                'response' => $response
            ], 200);
        } else {
            $response = [
                'code' => 400,
                'status' => 'success',
                'message' => 'Data Not Found'
            ];

            return response()->json([
                'data' => $stories,
                'response' => $response
            ], 200);
        }
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

        $stories = Stories::find($id);

        if (!isset($request->user_id)) {
            return response()->json(array(
                'code' => 409,
                'status' => 0,
                'message' => 'User Id is mandatory'
            ));
        }

        $user = Registration::where('id', $request->user_id)->first();

        if (!isset($user->id)) {
            return response()->json(array(
                'code' => 409,
                'status' => 0,
                'message' => 'User Not Found'
            ));
        }

        if (!$stories) {
            $response = [
                'code' => 400,
                'status' => 'failed',
                'message' => 'Update unsuccessful'
            ];

            return response()->json([
                'response' => $response
            ], 400);
        }

        $stories->title = $request->title ?? $stories->title;
        $stories->story = $request->story ?? $stories->story;
        $stories->tags = $request->tags ?? $stories->tags;
        $stories->user_id = $request->user_id ?? $stories->user_id;
        $stories->save();

        $response = [
            'code' => 200,
            'status' => 'success',
            'message' => 'Update Successful'
        ];

        return response()->json([
            'data' => $stories,
            'response' => $response
        ], 200);
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
        $stories = Stories::find($id)->delete();

        if (!$stories) {
            $response = [
                'code' => 400,
                'status' => 'failed',
                'message' => 'Delete unsuccessful'
            ];

            return response()->json([
                'response' => $response
            ], 400);
        }

        $response = [
            'code' => 200,
            'status' => 'success',
            'message' => 'Deleted successfully'
        ];

        return response()->json([
            'response' => $response
        ], 200);
    }
}
