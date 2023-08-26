<?php

namespace App\Http\Controllers\API\Admin;

use App\Consultation;
use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Socialization;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
  use ApiResponder;
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = Consultation::orderBy('status')->latest()->get();
    $a = [];

    foreach ($data as $d) {
      $x['id'] = $d->getKey();
      $x['nama'] = $d->nama;
      $x['status'] = $d->status;

      array_push($a, $x);
    }

    return $this->successResponse($a);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Consultation $consult)
  {
    $data = $consult->load('user');

    $x['id'] = $data->getKey();
    $x['nama'] = $data->nama;
    $x['alamat'] = $data->alamat;
    $x['jenis_kelamin'] = $data->jenis_kelamin;
    $date = Carbon::parse($data->tanggal_lahir)->locale('id');
    $date->settings(['formatFunction' => 'translatedFormat']);
    $x['tanggal_lahir'] = $date->format('d F Y');
    $x['zat'] = $data->zat;
    $x['durasi'] = $data->durasi;
    $x['status'] = $data->status;
    $x['user'] = $data->user->full_name ?? null;

    return $this->successResponse($x);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Consultation $consult)
  {
    $consult->status = Status::SELESAI;
    $consult->user_id = Auth::id();
    $consult->save();

    $data = $consult->load('user');

    $x['id'] = $data->getKey();
    $x['nama'] = $data->nama;
    $x['alamat'] = $data->alamat;
    $x['jenis_kelamin'] = $data->jenis_kelamin;
    $date = Carbon::parse($data->tanggal_lahir)->locale('id');
    $date->settings(['formatFunction' => 'translatedFormat']);
    $x['tanggal_lahir'] = $date->format('d F Y');
    $x['zat'] = $data->zat;
    $x['durasi'] = $data->durasi;
    $x['status'] = $data->status;
    $x['user'] = $data->user->full_name ?? null;

    return $this->successResponse($x);
  }
}
