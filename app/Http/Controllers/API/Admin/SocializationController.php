<?php

namespace App\Http\Controllers\API\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Socialization;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class SocializationController extends Controller
{
  use ApiResponder;
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = Socialization::orderBy('status')->latest()->get();
    $a = [];

    foreach ($data as $d) {
      $x['id'] = $d->getKey();
      $x['instansi'] = $d->instansi;
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
  public function show(Socialization $socialize)
  {
    $data = $socialize->load('user');

    $x['id'] = $data->getKey();
    $x['nama'] = $data->nama;
    $x['instansi'] = $data->instansi;
    $x['keperluan'] = $data->keperluan;
    $date = Carbon::parse($data->tanggal)->locale('id');
    $date->settings(['formatFunction' => 'translatedFormat']);
    $x['tanggal'] = $date->format('d F Y');
    $x['waktu'] = $data->waktu->format('h.i A');
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
  public function update(Request $request, Socialization $socialize)
  {
    $socialize->status = Status::SELESAI;
    $socialize->user_id = Auth::id();
    $socialize->save();

    $data = $socialize->load('user');

    $x['id'] = $data->getKey();
    $x['nama'] = $data->nama;
    $x['instansi'] = $data->instansi;
    $x['keperluan'] = $data->keperluan;
    $date = Carbon::parse($data->tanggal)->locale('id');
    $date->settings(['formatFunction' => 'translatedFormat']);
    $x['tanggal'] = $date->format('d F Y');
    $x['waktu'] = $data->waktu->format('h.i A');
    $x['status'] = $data->status;
    $x['user'] = $data->user->full_name ?? null;

    return $this->successResponse($x);
  }
}
