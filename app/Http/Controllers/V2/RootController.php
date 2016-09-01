<?php

namespace ATLauncher\Http\Controllers\V2;

use ATLauncher\Http\Controllers\Controller;

class RootController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        return response()->json('Hello, World!');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthenticated()
    {
        return response()->json('Hello, Authenticated!');
    }
}
