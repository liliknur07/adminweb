<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Socialization extends Model
{
  use HasFactory;

  protected $guarded = [];

  protected $casts = [
    'tanggal' => 'date',
    'waktu' => 'datetime',
  ];

  /**
   * Get the user that owns the Socialization
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
