<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like; //ここでインポートしていなかったので取得できなかった。
use Illuminate\Support\Facades\Redis;

class LikeController extends Controller
{
  public function like(Post $post, Request $request)
  {
    // user_idはログイン中のユーザー
    // post_idはコメントの番号
    $like = Like::create(['user_id' => $request->user_id, 'post_id' => $post->id]);

    return response()->json([]);
  }
}
