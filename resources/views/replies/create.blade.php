@extends('layouts.app')

{{-- ここからが自分自身が投稿したところ --}}
@section('content')
<form action="{{ route('replies.store') }}" method="post">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="comment">Comment:</label>
        <textarea class="form-control" rows="5" id="comment" name="text"></textarea>
        user_id:
        <input type="text" name="user_id" value="{{ Auth::id() }}">
        tweet_id:<input type="text" name="tweet_id">

      </div>
    <div class="form-group row mb-0">
        <div class="col-md-12 text-right">
            <p class="mb-4 text-danger">140文字以内</p>
            <button type="submit" class="btn btn-primary">
                コメントする
            <button>
        </div>
    </div>
    {{-- {{ $reply->id }} --}}
    @foreach ($replies as $item)
    <p class="ml-5">
        {{ $item->text }}      
        {{ $item->user_id }}
        {{ $item->tweet_id }}
    </p>
    @endforeach
</form>
@endsection