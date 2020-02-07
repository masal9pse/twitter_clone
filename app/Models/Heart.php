<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Heart extends Model
{
  protected $fillable = [
    'id', 'user_id', 'tweet_id'
  ];

  // 受け取っている
  public function tweet()
  {
    return $this->belongsTo(Tweet::class, 'tweet_id', 'id');
  }
  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }
}

// 住所テーブルのモデルを取ってこれる。
