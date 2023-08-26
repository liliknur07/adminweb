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
    Schema::create('abuses', function (Blueprint $table) {
      $table->id();
      $table->string('phone', 20);
      $table->string('kecamatan', 50);
      $table->string('alamat', 191);
      $table->string('long', 191);
      $table->string('lat', 191);
      $table->string('foto', 191);
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
    Schema::dropIfExists('abuses');
  }
};
