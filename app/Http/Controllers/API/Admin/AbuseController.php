<?php

namespace App\Http\Controllers\API\Admin;

use App\Abuse;
use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AbuseController extends Controller
{
  use ApiResponder;
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $data = Abuse::orderBy('status')->latest()->get();
    $a = [];

    foreach ($data as $d) {
      $x['id'] = $d->getKey();
      $x['kecamatan'] = $d->kecamatan;
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
  public function show(Abuse $abuse)
  {
    $data = $abuse->load('user');

    $x['id'] = $data->getKey();
    $x['phone'] = $data->phone;
    $x['kecamatan'] = $data->kecamatan;
    $x['alamat'] = $data->alamat;
    $x['long'] = $data->long;
    $x['lat'] = $data->lat;
    $x['foto'] = $data->foto;
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
  public function update(Request $request, Abuse $abuse)
  {
    $abuse->status = Status::SELESAI;
    $abuse->user_id = Auth::id();
    $abuse->save();

    $data = $abuse->load('user');

    $x['id'] = $data->getKey();
    $x['phone'] = $data->phone;
    $x['kecamatan'] = $data->kecamatan;
    $x['alamat'] = $data->alamat;
    $x['long'] = $data->long;
    $x['lat'] = $data->lat;
    $x['foto'] = $data->foto;
    $x['status'] = $data->status;
    $x['user'] = $data->user->full_name ?? null;

    return $this->successResponse($x);
  }
}
