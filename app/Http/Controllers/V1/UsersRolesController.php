<?php

namespace ATLauncher\Http\Controllers\V1;

use ATLauncher\Models\Role;
use ATLauncher\Models\User;
use ATLauncher\Http\Requests\CreateRole;
use ATLauncher\Http\Requests\DeleteRole;

use ATLauncher\Http\Controllers\Controller;

class UsersRolesController extends Controller
{
    /**
     * Lists all the given users roles.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        /** @var \ATLauncher\Models\User $user */
        $user = User::find($id);

        if (is_null($user)) {
            return response()->json([
                'code' => 404,
                'error' => 'User not found.'
            ], 404);
        }

        return response()->json($user->roles);
    }

    /**
     * Lists all the given users roles.
     *
     * @param \ATLauncher\Http\Requests\CreateRole $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function create(CreateRole $request, $id)
    {
        /** @var \ATLauncher\Models\User $user */
        $user = User::find($id);

        if (is_null($user)) {
            return response()->json([
                'code' => 404,
                'error' => 'User not found.'
            ], 404);
        }

        $user->roles()->attach($request->get('id'));

        return response()->json($user->roles);
    }

    /**
     * Deletes a role from a user.
     *
     * @param \ATLauncher\Http\Requests\DeleteRole $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete(DeleteRole $request, $id)
    {
        /** @var \ATLauncher\Models\User $user */
        $user = User::find($id);

        if (is_null($user)) {
            return response()->json([
                'code' => 404,
                'error' => 'User not found.'
            ], 404);
        }


        $user->roles()->detach($request->get('id'));

        return response()->json($user->roles);
    }
}
