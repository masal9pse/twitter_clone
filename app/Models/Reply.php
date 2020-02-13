<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public function user()
  {
    return $this->belongsTo(\App\Models\User::class, 'user_id');
  }

  public function comment(){
    return $this->belongsTo(\App\Models\Comment::class, 'comment_id');
  }
}
