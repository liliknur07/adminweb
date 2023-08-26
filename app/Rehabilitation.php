<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rehabilitation extends Model
{
  use HasFactory;

  protected $guarded = [];

  protected $casts = [
    'tanggal_lahir' => 'date'
  ];

  /**
   * Get the user that owns the Abuse
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
