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

  public function unlike(Post $post, Request $request)
  {
    $like = Like::where('user_id', $request->user_id)->where('post_id', $post->id)->first();
    $like->delete();

    return response()->json([]);
  }
}
