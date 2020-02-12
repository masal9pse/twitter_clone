<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Comment;

class CommentsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, Comment $comment)
  {
    $user = auth()->user();
    $data = $request->all();
    $validator = Validator::make($data, [
      'tweet_id' => ['required', 'integer'],
      'text'     => ['required', 'string', 'max:140']
    ]);

    $validator->validate();
    $comment->commentStore($user->id, $data);

    return back();
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Comment $comment)
  {
    $userAuth = \Auth::user();
    $comment->load('likes');
    // dd($userAuth);
    $defaultCount = count($comment->likes);
    $defaultLiked = $comment->likes->where('user_id', $userAuth->id)->first();
    if (is_countable($defaultLiked)) {
      if (count($defaultLiked) == 0) {
        $defaultLiked == false;
      } else {
        $defaultLiked == true;
      }
    }

    return view('tweets.show', [
      'post' => $comment,
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
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //
  }
}
