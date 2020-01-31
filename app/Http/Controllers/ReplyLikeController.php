<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReplyLike;

class ReplyLikeController extends Controller
{
  public function like(ReplyLike $replyLike, request $request)
  {
    $like = Like::create(['post_id' => $replyLike->id, 'user_id' => $request->user_id]);

    $likeCount = count(Like::where('post_id', $replyLike->id)->get());

    return response()->json(['likeCount' => $likeCount]);
  }

  //いいねを追加
  public function unlike(ReplyLike $replyLike, Request $request)
  {
    $like = Like::where('user_id', $request->user_id)->where('post_id', $replyLike->id)->first();
    $like->delete();

    $likeCount = count(Like::where('post_id', $replyLike->id)->get());

    return response()->json(['likeCount' => $likeCount]);
  }
}
