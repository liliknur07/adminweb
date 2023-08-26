<?php

namespace App\Http\Controllers\API\Netizen;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\RehabilitationRequest;
use App\Rehabilitation;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class RehabilitationController extends Controller
{
  use ApiResponder;
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke(RehabilitationRequest $request)
  {
    $data = Rehabilitation::create([
      'nama' => $request->nama,
      'alamat' => $request->alamat,
      'jenis_kelamin' => $request->jenis_kelamin,
      'tanggal_lahir' => $request->tanggal_lahir,
      'zat' => $request->zat,
      'durasi' => $request->durasi,
      'phone' => $request->phone,
      'status' => Status::MENUNGGU
    ]);

    return $this->successResponse($data);
  }
}
