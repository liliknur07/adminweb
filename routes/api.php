<?php

use App\Http\Controllers\API\Admin\AbuseController as AdminAbuseController;
use App\Http\Controllers\API\Admin\ConsultationController as AdminConsultationController;
use App\Http\Controllers\API\Admin\RehabilitationController as AdminRehabilitationController;
use App\Http\Controllers\API\Admin\SocializationController as AdminSocializationController;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Netizen\AbuseController;
use App\Http\Controllers\API\Netizen\ConsultationController;
use App\Http\Controllers\API\Netizen\RehabilitationController;
use App\Http\Controllers\API\Netizen\SocializationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('online', function () {
  return response()->json(['status' => 'online']);
});

// Masyarakat
Route::post('abuse', AbuseController::class);
Route::post('socialize', SocializationController::class);
Route::post('rehabilitate', RehabilitationController::class);
Route::post('consult', ConsultationController::class);

// User
Route::post('login', LoginController::class);

// Admin
Route::middleware('auth:sanctum')->group(function () {
  Route::get('user', function (Request $request) {
    return $request->user();
  });
  Route::post('logout', LogoutController::class);

  Route::prefix('admin')->group(function () {
    Route::resource('abuse', AdminAbuseController::class)->only('index', 'show', 'update');
    Route::resource('socialize', AdminSocializationController::class)->only('index', 'show', 'update');
    Route::resource('rehabilitate', AdminRehabilitationController::class)->only('index', 'show', 'update');
    Route::resource('consult', AdminConsultationController::class)->only('index', 'show', 'update');
  });
});
