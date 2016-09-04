<?php

namespace ATLauncher\Http\Controllers\V1;

use ATLauncher\Http\Controllers\Controller;

class RootController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        $response = [
            'authenticated' => false
        ];

        /** @var \ATlauncher\Models\User $user */
        $user = \Auth::guard('api')->user();

        if (!is_null($user)) {
            $response['authenticated'] = true;
            $response['scopes'] = $user->token()->scopes;
        }

        return response()->json($response);
    }
}
