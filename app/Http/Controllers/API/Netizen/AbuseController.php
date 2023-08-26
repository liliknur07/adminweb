<?php

namespace App\Http\Controllers\API\Netizen;

use App\Abuse;
use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\AbuseRequest;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class AbuseController extends Controller
{
  use ApiResponder;
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke(AbuseRequest $request)
  {
    $data = Abuse::create([
      'phone' => $request->phone,
      'kecamatan' => $request->kecamatan,
      'alamat' => $request->alamat,
      'long' => $request->long,
      'lat' => $request->lat,
      'foto' => $request->foto->store('abuse'),
      'status' => Status::MENUNGGU,
    ]);

    return $this->successResponse($data);
  }
}
