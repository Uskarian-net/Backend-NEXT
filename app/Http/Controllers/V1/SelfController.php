<?php

namespace ATLauncher\Http\Controllers\V1;

use ATLauncher\Http\Controllers\Controller;

class SelfController extends Controller
{
    /**
     * Gets the current authenticated users details.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /** @var \ATLauncher\Models\User $user */
        $user = \Auth::guard()->user();

        return response()->json($user->makeHidden('roles')->toArray());
    }

    /**
     * Gets the current authenticated users roles.
     *
     * @return \Illuminate\Http\Response
     */
    public function roles()
    {
        /** @var \ATLauncher\Models\User $user */
        $user = \Auth::guard()->user();

        return response()->json($user->roles);
    }
}
