<?php

namespace App\Http\Controllers\API\Netizen;

use App\Consultation;
use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultationRequest;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
  use ApiResponder;
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke(ConsultationRequest $request)
  {
    $data = Consultation::create([
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
