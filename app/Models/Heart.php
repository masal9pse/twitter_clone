<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Heart extends Model
{
  protected $fillable = [
    'id', 'user_id', 'tweet_id'
  ];
}
