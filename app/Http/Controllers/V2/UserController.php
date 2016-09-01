<?php

namespace ATLauncher\Http\Controllers\V2;

use ATLauncher\Models\User;
use Illuminate\Http\Request;

use ATLauncher\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Instantiate a new new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth:api');

        $this->middleware('scopes:users:list')->only('index');
        $this->middleware('scopes:users:create')->only('store');
        $this->middleware('scopes:users:read')->only('show');
        $this->middleware('scopes:users:update')->only('update');
        $this->middleware('scopes:users:delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json('store');
    }

    /**
     * Display the specified resource.
     * 
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return response()->json('user not found')->setStatusCode(404);
        }

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json('destroy');
    }
}
