<?php

namespace ATLauncher\Http\Controllers\V1;

use ATLauncher\Http\Requests\UpdateUser;
use ATLauncher\Models\User;
use ClassesWithParents\F;
use Illuminate\Http\Request;
use ATLauncher\Http\Requests\CreateUser;

use ATLauncher\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Lists all the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Creates a new user.
     *
     * @param \ATLauncher\Http\Requests\CreateUser $request
     * @return \Illuminate\Http\Response
     */
    public function create(CreateUser $request)
    {
        /** @var \ATLauncher\Models\User $user */
        $user = new User;
        $user->username = $request->get('username');
        $user->email = $request->get('email');
        $user->password = \Hash::make($request->get('password'));
        $user->must_change_password = $request->get('must_change_password', false);

        if (!$user->save()) {
            return response()->json([
                'code' => 500,
                'error' => 'Error creating user.'
            ], 500);
        }

        return response()->json($user, 201);
    }

    /**
     * Gets a single users details.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function read($id)
    {
        /** @var \ATLauncher\Models\User $user */
        $user = User::find($id);

        if (is_null($user)) {
            return response()->json([
                'code' => 404,
                'error' => 'User not found.'
            ], 404);
        }

        return response()->json($user);
    }

    /**
     * Update a users details.
     *
     * @param \ATLauncher\Http\Requests\UpdateUser $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        /** @var \ATLauncher\Models\User $user */
        $user = User::find($id);

        if (is_null($user)) {
            return response()->json([
                'code' => 404,
                'error' => 'User not found.'
            ], 404);
        }

        if ($request->has('username')) {
            $user->username = $request->get('username');
        }

        if ($request->has('email')) {
            $user->email = $request->get('email');
        }

        if ($request->has('password')) {
            $user->password = \Hash::make($request->get('password'));
        }

        if ($request->has('must_change_password')) {
            $user->must_change_password = $request->get('must_change_password');
        }

        if (!$user->save()) {
            return response()->json([
                'code' => 500,
                'error' => 'Error updating user.'
            ], 500);
        }

        return response()->json($user);
    }

    /**
     * Delete a user.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        /** @var \ATLauncher\Models\User $user */
        $user = User::find($id);

        if (is_null($user)) {
            return response()->json([
                'code' => 404,
                'error' => 'User not found.'
            ], 404);
        }

        if (!$user->delete()) {
            return response()->json([
                'code' => 500,
                'error' => 'Error deleting user.'
            ], 500);
        }

        return \Response::make(null, 204);
    }
}
