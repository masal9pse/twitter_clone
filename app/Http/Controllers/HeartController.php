<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Heart;
use App\Models\Comment;

class HeartController extends Controller
{
  public function heart(Comment $comment, Request $request)
  {
    $heart = Heart::create(['user_id' => $request->user_id, 'tweet_id' => $comment->id]);
    // dd($heart);

    $heartCount = count(Heart::where('tweet_id', $comment->id)->get());

    return response()->json(['heartCount' => $heartCount]);
  }

  public function unheart(Comment $comment, Request $request)
  {
    $heart = Heart::where('user_id', $request->user_id)->where('tweet_id', $comment->id)->first();
    $heart->delete();

    $heartCount = count(Heart::where('tweet_id', $comment->id)->get());

    return response()->json(['likeCount' => $heartCount]);
  }
}
