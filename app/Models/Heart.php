<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Heart extends Model
{
  protected $fillable = [
    'id', 'user_id', 'tweet_id'
  ];

  public function tweet()
  {
    return $this->belongsTo(\App\Models\Comment::class, 'tweet_id', 'id');
  }

  public function user()
  {
    return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
  }
}
