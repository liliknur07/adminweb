<?php

namespace App\Http\Controllers;

use App\Abuse;
use App\Consultation;
use App\Enums\Status;
use App\Rehabilitation;
use App\Socialization;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    return view('home', [
      'title' => 'Dashboard - BNN',
      'abuses_pending' => Abuse::whereStatus(Status::MENUNGGU)->count(),
      'abuses_done' => Abuse::whereStatus(Status::SELESAI)->count(),
      'socializations_pending' => Socialization::whereStatus(Status::MENUNGGU)->count(),
      'socializations_done' => Socialization::whereStatus(Status::SELESAI)->count(),
      'rehabilitations_pending' => Rehabilitation::whereStatus(Status::MENUNGGU)->count(),
      'rehabilitations_done' => Rehabilitation::whereStatus(Status::SELESAI)->count(),
      'consultations_pending' => Consultation::whereStatus(Status::MENUNGGU)->count(),
      'consultations_done' => Consultation::whereStatus(Status::SELESAI)->count(),
    ]);
  }
}
