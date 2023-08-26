<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class LogoutController extends Controller
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
    $request->user()->currentAccessToken()->delete();

    return $this->successResponse('Logout Successfully');
  }
}
