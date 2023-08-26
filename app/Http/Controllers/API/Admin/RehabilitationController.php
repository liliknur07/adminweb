<?php

namespace App\Http\Controllers\API\Admin;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Rehabilitation;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RehabilitationController extends Controller
{
  use ApiResponder;
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = Rehabilitation::orderBy('status')->latest()->get();
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
  public function show(Rehabilitation $rehabilitate)
  {
    $data = $rehabilitate->load('user');

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
  public function update(Request $request, Rehabilitation $rehabilitate)
  {
    $rehabilitate->status = Status::SELESAI;
    $rehabilitate->user_id = Auth::id();
    $rehabilitate->save();

    $data = $rehabilitate->load('user');

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
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
