<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('consultations', function (Blueprint $table) {
      $table->id();
      $table->string('nama', 191);
      $table->string('alamat', 191);
      $table->string('jenis_kelamin', 20);
      $table->date('tanggal_lahir');
      $table->string('zat', 191);
      $table->string('durasi', 191);
      $table->string('phone', 20);
      $table->string('status', 50);
      // $table->string('catatan', 50)->nullable();
      $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('consultations');
  }
};
