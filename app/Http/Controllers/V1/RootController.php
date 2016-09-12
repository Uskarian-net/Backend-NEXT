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
            /** @var \Laravel\Passport\Token $token */
            $token = $user->token();

            $response['authenticated'] = true;
            $response['scopes'] = $token->scopes;
            $response['created_at'] = $token->created_at;
            $response['expires_at'] = $token->expires_at->toDateTimeString();
        }

        return response()->json($response);
    }
}
