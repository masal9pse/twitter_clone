<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Tweet extends Model
{
  use SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'text'
  ];

  // TweetsTableとUsersTableを紐づける
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function heart()
  {
    return $this->hasMany(Heart::class);
  }


  public function favorites()
  {
    return $this->hasMany(Favorite::class);
  }

  // TweeetsTableとcommentsTableを紐づける。
  public function comments()
  {
    return $this->hasMany(Comment::class);
  }

  public function getUserTimeLine(Int $user_id)
  {
    return $this->where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(50);
  }

  public function getTweetCount(Int $user_id)
  {
    return $this->where('user_id', $user_id)->count();
  }
  //一覧画面
  public function getTimeLines(Int $user_id, array $follow_ids)
  {
    $follow_ids[] = $user_id;
    return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'DESC')->paginate(50);
  }

  // 詳細画面
  public function getTweet(Int $tweet_id)
  {
    return $this->with('user')->where('id', $tweet_id)->first();
  }

  public function tweetStore(Int $user_id, array $data)
  {
    $this->user_id = $user_id;
    $this->text = $data['text'];
    $this->save();

    return;
  }

  public function getEditTweet(Int $user_id, Int $tweet_id)
  {
    return $this->where('user_id', $user_id)->where('id', $tweet_id)->first();
  }

  public function tweetUpdate(Int $tweet_id, array $data)
  {
    $this->id = $tweet_id;
    $this->text = $data['text'];
    $this->update();

    return;
  }

  public function tweetDestroy(Int $user_id, Int $tweet_id)
  {
    return $this->where('user_id', $user_id)->where('id', $tweet_id)->delete();
  }

  // 一つのいいねに対してたくさんのユーザーからいいねがつく。hasMany

  public static function defaultLiked($tweet, $user_auth_id)
  {
    $defaultLiked = 0;
    foreach ($tweet['hearts'] as $key => $heart) {
      if ($heart['user_id'] == $user_auth_id) {
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
// $like = $heart
// $post = $tweet
