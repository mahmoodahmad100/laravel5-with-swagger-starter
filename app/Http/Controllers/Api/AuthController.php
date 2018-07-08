<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Exception;

class AuthController extends ApiController
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Post(
     *     path="/auth/login",
     *     produces={"application/json"},
     *     tags={"Auth"},
     *     @SWG\Parameter(
     *         name="data",
     *         required=true,
     *         in="body",
     *         @SWG\Schema(
     *              type="object",
     *              required={"email", "password"},
     *              @SWG\Property(
     *                  property="email",
     *                  type="string",
     *                  description="user email"
     *              ),
     *              @SWG\Property(
     *                  property="password",
     *                  type="string",
     *                  description="user password"
     *              ),
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful action."
     *     )
     * )
     */
    public function login(Request $request)
    {
	   if( ! $token = auth()->attempt(['email' => $request->email, 'password' => $request->password]) ) {
	       return response()->json(['error' => 'please login with the correct data'], 401);
	   }
	   return response()->json(['data' => compact('token')]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Get(
     *     path="/auth/me",
     *     produces={"application/json"},
     *     tags={"Auth"},
     *     @SWG\Parameter(
     *         name="Authorization",
     *         in="header",
     *         description="Bearer + token",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful action."
     *     )
     * )
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
	 *
     * @SWG\Get(
     *     path="/auth/logout",
     *     produces={"application/json"},
     *     tags={"Auth"},
     *     @SWG\Parameter(
     *         name="Authorization",
     *         in="header",
     *         description="Bearer + token",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful action."
     *     )
     * )
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @SWG\Get(
     *     path="/auth/refresh",
     *     produces={"application/json"},
     *     tags={"Auth"},
     *     @SWG\Parameter(
     *         name="Authorization",
     *         in="header",
     *         description="Bearer + token",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful action."
     *     )
     * )
     */
    public function refresh()
    {
        $token = auth()->refresh();
        return response()->json(['data' => compact('token')]);
    }

}
