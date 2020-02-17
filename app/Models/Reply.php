<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
  protected $fillable = [
    'id','text','comment_id'
  ];

    public function user()
  {
    return $this->belongsTo(\App\Models\User::class, 'user_id');
  }

  public function comments(){
    return $this->belongsTo(\App\Models\Comment::class, 'comment_id','id');
  }

  public function commentStore($user_id,$data)
  {
    $this->user_id = $user_id;
    $this->text = $data['text'];
    // $this->save();

    return;
  }
}
