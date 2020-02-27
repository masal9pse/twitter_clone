<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Providers\Validator;

class User extends Authenticatable
{
 use Notifiable;

 /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
 protected $fillable = [
  'screen_name',
  'name',
  'profile_image',
  'email',
  'password'
 ];

 protected $hidden = [
  'password', 'remember_token',
 ];

 public function likes()
 {
  return $this->hasMany('App\Models\Like', 'user_id', 'id');
 }

 public function heart()
 {
  return $this->hasMany('App\Models\Heart', 'user_id', 'id');
 }



 public function followers()
 {
  return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
 }

 public function follows()
 {
  return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
 }

 public function getAllUsers(Int $user_id)
 {
  return $this->where('id', '<>', $user_id)->paginate(5);
 }

 public function follow(Int $user_id)
 {
  return $this->follows()->attach($user_id);
 }

 // フォロー解除する
 public function unfollow(Int $user_id)
 {
  return $this->follows()->detach($user_id);
 }

 // フォローしているか
 public function isFollowing(Int $user_id)
 {
  return (bool) $this->follows()->where('followed_id', $user_id)->first(['id']);
 }

 // フォローされているか
 public function isFollowed(Int $user_id)
 {
  return (bool) $this->followers()->where('following_id', $user_id)->first(['id']);
 }

 // 画像ファイルが/storage/app/public/profile_image/に保存されます。 
 public function updateProfile(array $params)
 {
  if (isset($params['profile_image'])) {
   $file_name = $params['profile_image']->store('public/profile_image/');

   $this::where('id', $this->id)
    ->update([
     'screen_name'   => $params['screen_name'],
     'name'          => $params['name'],
     'profile_image' => basename($file_name),
     'email'         => $params['email'],
    ]);
  } else {
   $this::where('id', $this->id)
    ->update([
     'screen_name'   => $params['screen_name'],
     'name'          => $params['name'],
     'email'         => $params['email'],
    ]);
  }

  return;
 }
}
