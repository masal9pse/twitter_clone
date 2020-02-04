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

  public static function defaultLiked($post, $user_auth_id)
  {
    // $defaultLiked = $post->likes->where('user_id', $user_auth_id)->first();

    $defaultLiked = 0;
    foreach ($post['likes'] as $key => $like) {
      if ($like['user_id'] == $user_auth_id) {
        $defaultLiked = 1;
        break;
      }
    }

    if (is_countable($defaultLiked)) {
      if (count($defaultLiked) == 0) {
        $defaultLiked == false;
      } else {
        $defaultLiked == true;
      }
    }

    return $defaultLiked;
  }
}
