<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Heart;
use App\Models\Tweet;

class HeartController extends Controller
{
  public function heart(Tweet $tweet, Request $request)
  {
    \Debugbar::info($tweet);
    $heart = Heart::create(['user_id' => $request->user_id, 'tweet_id' => $tweet->id]);
    // dd($request->user_id);
    $heartCount = count(Heart::where('tweet_id', $tweet->id)->get());

    return response()->json(['heartCount' => $heartCount]);
  }

  public function unheart(Tweet $tweet, Request $request)
  {
    $heart = Heart::where('user_id', $request->user_id)->where('tweet_id', $tweet->id)->first();
    $heart->delete();

    $heartCount = count(Heart::where('tweet_id', $tweet->id)->get());

    return response()->json(['likeCount' => $heartCount]);
  }
}
