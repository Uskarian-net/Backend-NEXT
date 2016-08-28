<?php

namespace ATLauncher\Http\Controllers;

class RootController extends Controller
{

    /**
     * @SWG\Get(
     *     path="/",
     *     summary="Returns a hello world message",
     *     tags={"root"},
     *     description="Simply returns a hello world message used for testing things out.",
     *     operationId="get",
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
}
