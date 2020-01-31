<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplyLike extends Model
{
  //いいねを取得
  public static function getIine(request $request)
  {
    $model = new Iine;

    $model->foreign_key = $request->foreign_key;
    $model->user_id = $request->user_id;
    $model->model = $request->model;


    $tmp = $model
      ->select('id')
      ->first();

    //要素の存在チェック bool
    if (!empty($tmp->id)) {
      $res = true;
    } else {
      $res = false;
    }

    return response()->json(['res' => $res]);
  }

  //いいねを追加
  public static function addIine(request $request)
  {
    $model = new Iine;

    $model->foreign_key = $request->foreign_key;
    $model->user_id = $request->user_id;
    $model->model = $request->model;



    $tmp = $model
      ->select('id')
      ->first();


    //要素の存在チェック bool
    if (!empty($tmp->id)) {
      $res = false;
      $model
        ->where('id', $tmp->id)
        ->delete(); //削除
    } else {
      $res = true;
      $model->save();
    }

    return response()->json(['res' => $res]);
  }
}
