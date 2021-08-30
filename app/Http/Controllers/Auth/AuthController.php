<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @group Authentication
 *
 * ###APIs for managing authentication
 *
 * Class AuthController
 * @package App\Http\Controllers\Auth
 *
 * @OA\Info(title="ToDo API", version="0.1")
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="Authorization",
 *      type="http",
 *      scheme="Bearer",
 *      bearerFormat="JWT",
 * ),
 */
class AuthController extends Controller
{

    /**
     * AuthController constructor.
     * @param ResponseGeneral $responseStructured
     */
    public function __construct() {
        //
    }


    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Auth"},
     *     summary="Authorizes the user",
     *     description="Authorizes the user.",
     *     @OA\Parameter(
     *        name="client_id", in="query",required=true, @OA\Schema(type="string"), description="",
     *     ),
     *     @OA\Parameter(
     *        name="client_secret", in="query",required=true, @OA\Schema(type="string"), description="",
     *     ),
     *     @OA\Response(response="200", description="OK")
     * )
     */
    public function login(LoginRequest $request)
    {
        return $request->login();
    }

    /**
     * Logout
     *
     * ###Logout user from system.
     *
     * @authenticated
     *
     * @response {
     *  "status": true,
     *  "message": "message success"
     * }
     *
     * @response 401 {
     *  "status": false,
     *  "message": "errors[]"
     * }
     *
     * @param Request $request
     * @return array
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return $this->getResponse();
        //return $this->responseStructured->getResponse();
    }
}
