<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class LikeController extends Controller
{
  public function like(Post $post)
  {
    // 'post_id = 認証しているuserTableのidと紐づける。
    // user_id = コメントした（postTable）idと紐づける。
    // これでDBにいいねした値を突っ込める
    // dd(\Auth::user());
    $like = Like::create(['post_id' => \Auth::user()->id, 'user_id' => $post->id]);

    return response()->json([]);
  }
}
