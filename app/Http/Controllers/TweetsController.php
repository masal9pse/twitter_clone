<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tweet;
use App\Models\Comment;
use App\Models\Follower;
use App\Models\Heart;

class TweetsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Tweet $tweet, Follower $follower)
  {
    $user = auth()->user();
    $follow_ids = $follower->followingIds($user->id);
    // dd($follow_ids);
    $following_ids = $follow_ids->pluck('followed_id')->toArray();
    // dd($following_ids);
    $timelines = $tweet->getTimelines($user->id, $following_ids);
    return view('tweets.index', compact('user', 'timelines'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $user = auth()->user();
    return view('tweets.create', [
      'user' => $user
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Tweet $tweet)
  {
    $user = auth()->user();
    $data = $request->all();
    $validator = Validator::make($data, [
      'text' => ['required', 'string', 'max:140']
    ]);

    $validator->validate();
    $tweet->tweetStore($user->id, $data);
    return redirect('tweets');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  // 恐らくここに返信に対してのいいねの処理を書けばいいはず
  public function show(Tweet $tweet, Comment $comment, Heart $heart)
  {
    $user = auth()->user();
    $tweet = $tweet->getTweet($tweet->id);
    $comments = $comment->getComments($tweet->id);

    $userAuth = \Auth::user();
    // $tweet->heart;
    $tweet->load('heart');

    $defaultCount = count($tweet->heart);
    // dd($defaultCount);
    $defaultLiked = $tweet->heart->where('user_id', $userAuth->id)->first();
    // dd($defaultLiked);
    if (is_countable($defaultLiked)) {
      if (count($defaultLiked) == 0) {
        $defaultLiked == false;
      } else {
        $defaultLiked == true;
      }
    }

    return view('tweets.show', [
      'user'     => $user,
      'tweet' => $tweet,
      'heart' => $heart,
      'comments' => $comments,
      'userAuth' => $userAuth,
      'defaultLiked' => $defaultLiked,
      'defaultCount' => $defaultCount
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Tweet $tweet)
  {
    $user = auth()->user();
    $tweets = $tweet->getEditTweet($user->id, $tweet->id);

    if (!isset($tweets)) {
      return redirect('tweets');
    }

    return view('tweets.edit', [
      'user'   => $user,
      'tweets' => $tweets
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Tweet $tweet)
  {
    $data = $request->all();
    $validator = Validator::make($data, [
      'text' => ['required', 'string', 'max:140']
    ]);

    $validator->validate();
    $tweet->tweetUpdate($tweet->id, $data);

    return redirect('tweets');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Tweet $tweet)
  {
    $user = auth()->user();
    $tweet->tweetDestroy($user->id, $tweet->id);

    return back();
  }
}
