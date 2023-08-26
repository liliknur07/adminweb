<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
  use ApiResponder;
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke(Request $request)
  {
    $user = User::where('nik', $request->nik)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
      return $this->errorResponse('Invalid credentials', Response::HTTP_UNAUTHORIZED);
    }

    return $this->successResponse([
      'token' => $user->createToken($request->nik)->plainTextToken
    ]);
  }
}
