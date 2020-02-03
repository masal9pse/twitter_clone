<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Redis;

class LikeController extends Controller
{
  public function like(Post $post, Request $request)
  {
    dd($request->user_id);
    $like = Like::create(['post_id' => \Auth::user()->id, 'user_id' => $post->id]);

    return response()->json([]);
  }
}
