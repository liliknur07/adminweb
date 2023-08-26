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
    Schema::create('socializations', function (Blueprint $table) {
      $table->id();
      $table->string('nama', 191);
      $table->string('instansi', 191);
      $table->string('keperluan', 191);
      $table->date('tanggal');
      $table->time('waktu');
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
    Schema::dropIfExists('socializations');
  }
};
