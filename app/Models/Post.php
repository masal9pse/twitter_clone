<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Like;

class Post extends Model
{
  protected $fillable = [
    'id', 'user_id', 'content'
  ];

  // 一つのいいねに対してたくさんのユーザーからいいねがつく。hasMany
  public function likes()
  {
    return $this->hasMany('App\Models\Like');
  }
}
