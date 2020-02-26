<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
 protected $fillable = [
  'id', 'text', 'tweet_id', 'user_id'
 ];

 public function user()
 {
  return $this->belongsTo(\App\Models\User::class, 'user_id');
 }

 public function comments()
 {
  return $this->belongsTo(\App\Models\Comment::class, 'tweet_id', 'id');
 }

 public function commentStore($user_id, $data)
 {
  $this->user_id = $user_id;
  $this->text = $data['text'];

  return;
 }

 public function getReply(Int $tweet_id)
 {
  return $this->with('user')->where('tweet_id', $tweet_id)->get();
 }
}
