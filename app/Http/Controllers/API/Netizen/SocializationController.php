<?php

namespace App\Http\Controllers\API\Netizen;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\SocializationRequest;
use App\Socialization;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class SocializationController extends Controller
{
  use ApiResponder;
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke(SocializationRequest $request)
  {
    $data = Socialization::create([
      'nama' => $request->nama,
      'instansi' => $request->instansi,
      'keperluan' => $request->keperluan,
      'tanggal' => $request->tanggal,
      'waktu' => $request->waktu,
      'status' => Status::MENUNGGU
    ]);

    return $this->successResponse($data);
  }
}
