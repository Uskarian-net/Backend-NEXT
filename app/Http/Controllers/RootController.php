<?php

namespace ATLauncher\Http\Controllers;

class RootController extends Controller
{
    /**
     * @SWG\Get(
     *     path="/v2",
     *     summary="Returns a hello world message.",
     *     tags={"root"},
     *     description="Simply returns a hello world message used for testing things out.",
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="string"
     *         )
     *     )
     * )
     */
    public function get() {
        return response()->json('Hello, World!');
    }

    /**
     * @SWG\Get(
     *     path="/v2/authenticated",
     *     summary="Route to test OAuth.",
     *     tags={"root"},
     *     description="This route is simply here to test OAuth authentication.",
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="string"
     *         )
     *     ),
     *     @SWG\Response(
     *         response="401",
     *         description="unauthenticated"
     *     ),
     *     security={
     *         {
     *             "oauth": {"read:self"}
     *         }
     *     }
     * )
     */
    public function getAuthenticated() {
        return response()->json('Hello, Authenticated!');
    }
}
