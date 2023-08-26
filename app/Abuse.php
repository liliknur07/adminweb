<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Abuse extends Model
{
  use HasFactory;

  protected $guarded = [];

  public function getFotoAttribute($value)
  {
    if (strpos($value, 'http') === false) {
      return Storage::url($value);
    } else {
      return $value;
    }
  }

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
