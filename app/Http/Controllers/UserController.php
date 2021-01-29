<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class UserController extends Controller
{
  /**
   * Create a new UserController instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth:api', ['only' => ['logout', 'destroy']]);
  }

  /**
   * Create a new user.
   * POST request.
   *
   * @param  \Illuminate\Http\Request
   * @return \Illuminate\Http\JsonResponse
   */
  public function store(Request $request)
  {
    $user = new User;

    // Validate incoming data.
    $validator = Validator::make($request->all(), [
      'email' => ['required', 'unique:users,email', 'email'],
      'password' => ['required', 'max:' . config('api.max_password_length')],
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ], Response::HTTP_BAD_REQUEST);
    }

    // If data is good, save new record to database.
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();
    
    // Create a JWT.
    $token = auth()->login($user);

    // Return a JWT to the new user.
    return $this->respondWithToken($token, Response::HTTP_CREATED);
  }

  /**
   * Login a user. Gets a JWT via credentials.
   * POST request.
   *
   * @param  \Illuminate\Http\Request
   * @return \Illuminate\Http\JsonResponse
   */
  public function login(Request $request)
  {
    // Validate incoming data.
    $validator = Validator::make($request->only(['email', 'password']), [
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error' => $validator->errors(),
      ], Response::HTTP_BAD_REQUEST);
    }

    // If data is good, attempt to login user.
    $token = auth()->attempt($request->only(['email', 'password']));

    if (!$token) {
      return response()->json([
        'error' => 'Invalid credentials',
      ], Response::HTTP_UNAUTHORIZED);
    }

    return $this->respondWithToken($token, Response::HTTP_OK);
  }

  /**
   * Log a user out. Invalidate JWT.
   * POST request.
   *
   * @return \Illuminate\Http\JsonResponse
   */
  public function logout()
  {
    auth()->logout();

    return response()->json([
      'message' => 'Successfully logged out'
    ], Response::HTTP_OK);
  }

  /**
   * Close account / delete a user.
   * DELETE request.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    // If user does not exist, cannot delete.
    $user = User::find($id);

    if (!$user) {
      return response()->json([
        'error' => 'User could not be deleted'
      ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    // Otherwise delete user and invalidate JWT.
    User::destroy($id);
    auth()->invalidate();

    return response()->json([
      'message' => 'User deleted'
    ], Response::HTTP_OK); 
  }

  /**
   * Get the token array structure.
   *
   * @param  string $token
   *
   * @return \Illuminate\Http\JsonResponse
   */
  protected function respondWithToken($token, $httpcode)
  {
    return response()->json([
      'token' => $token,
      'token_type' => 'bearer',
      'expires_in' => auth()->factory()->getTTL() * 60,
    ], $httpcode);
  }
}