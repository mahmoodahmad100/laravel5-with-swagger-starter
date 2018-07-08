<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource..
     *
     * @param  object  $users
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/users",
     *     produces={"application/json"},
     *     tags={"User"},
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
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Unauthorized action.",
     *     )
     * )
     */
    public function index(User $users)
    {
        return $users->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  object  $user
     * @return \Illuminate\Http\Response
     *
     * @SWG\Post(
     *     path="/users",
     *     produces={"application/json"},
     *     tags={"User"},
     *     @SWG\Parameter(
     *         name="Authorization",
     *         in="header",
     *         description="Bearer + token",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="data",
     *         required=true,
     *         in="body",
     *         @SWG\Schema(
     *              type="object",
     *              required={"name", "email", "password"},
     *              @SWG\Property(
     *                  property="name",
     *                  type="number",
     *                  description="the name of the user"
     *              ),
     *              @SWG\Property(
     *                  property="email",
     *                  type="number",
     *                  description="the email of the user"
     *              ),
     *              @SWG\Property(
     *                  property="password",
     *                  type="number",
     *                  description="the password of the user"
     *              )
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=201,
     *         description="successful action."
     *     )
     * )
     */
    public function store(UserRequest $request, User $user)
    {
          $user = $user->create([
               'name'     => $request->name,
               'email'    => $request->email,
               'password' => $request->password,
          ]);

          $token = Auth::fromUser($user);
          return response()->json(['data' => compact('token')], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  object  $user
     * @return \Illuminate\Http\Response
     *
     * @SWG\Get(
     *     path="/users/{id}",
     *     produces={"application/json"},
     *     tags={"User"},
     *     @SWG\Parameter(
     *         name="Authorization",
     *         in="header",
     *         description="Bearer + token",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="id",
     *         description="user id",
     *         required=true,
     *         type="integer",
     *         in="path"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful action."
     *     )
     * )
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * update a resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  object  $user
     * @return \Illuminate\Http\Response
     *
     * @SWG\Patch(
     *     path="/users/{id}",
     *     produces={"application/json"},
     *     tags={"User"},
     *     @SWG\Parameter(
     *         name="Authorization",
     *         in="header",
     *         description="Bearer + token",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="id",
     *         description="user id",
     *         required=true,
     *         type="integer",
     *         in="path"
     *     ),
     *     @SWG\Parameter(
     *         name="data",
     *         required=true,
     *         in="body",
     *         @SWG\Schema(
     *              type="object",
     *              required={},
     *              @SWG\Property(
     *                  property="name",
     *                  type="number",
     *                  description="the name of the user"
     *              ),
     *              @SWG\Property(
     *                  property="email",
     *                  type="number",
     *                  description="the email of the user"
     *              ),
     *              @SWG\Property(
     *                  property="password",
     *                  type="number",
     *                  description="the password of the user"
     *              )
     *         ),
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful action."
     *     )
     * )
     */
    public function update(UserRequest $request, User $user)
    {
          $user->update([
               'name'     => $request->name,
               'email'    => $request->email,
               'password' => $request->password,
          ]);

          return response()->json('successful action.',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  object  $user
     * @return \Illuminate\Http\Response
     *
     * @SWG\Delete(
     *     path="/users/{id}",
     *     produces={"application/json"},
     *     tags={"User"},
     *     @SWG\Parameter(
     *         name="Authorization",
     *         in="header",
     *         description="Bearer + token",
     *         required=true,
     *         type="string"
     *     ),
     *     @SWG\Parameter(
     *         name="id",
     *         description="user id",
     *         required=true,
     *         type="integer",
     *         in="path"
     *     ),
     *     @SWG\Response(
     *         response=204,
     *         description="successful action."
     *     )
     * )
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json('successful action.',204);
    }
}