@extends('layouts.app')

{{-- ここからが自分自身が投稿したところ --}}
@section('content')
<div class="container" id="app">
  <div class="row justify-content-center mb-5">
    <div class="col-md-8 mb-3">
      <div class="col-md-8 mb-3 text-right">
        <a href="{{ url('users') }}">ユーザ一覧 <i class="fas fa-users" class="fa-fw"></i> </a>
        <a href="{{ route('posts.index') }}" class="ml-3">post一覧へ<i class="fas fa-users" class="fa-fw"></i></a>
      </div>
      <div class="card">
        <div class="card-haeder p-3 w-100 d-flex">
          <img src="{{ $tweet->user->profile_image }}" class="rounded-circle" width="50" height="50">
          <div class="ml-2 d-flex flex-column">
            <p class="mb-0">{{ $tweet->user->name }}</p>
            <a href="{{ url('users/' .$tweet->user->id) }}" class="text-secondary">{{ $tweet->user->screen_name }}</a>
          </div>
          <div class="d-flex justify-content-end flex-grow-1">
            <p class="mb-0 text-secondary">{{ $tweet->created_at->format('Y-m-d H:i') }}</p>
          </div>
        </div>

        {{-- 自分のツイート内容がここで表示されている --}}
        <div class="card-body">
          {!! nl2br(e($tweet->text)) !!}
        </div>

        {{-- コメントといいねの追加機能 --}}
        <div class="card-footer py-1 d-flex justify-content-end bg-white">
          @if ($tweet->user->id === Auth::user()->id)
          <div class="dropdown mr-3 d-flex align-items-center">
            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-fw"></i>
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <form method="POST" action="{{ url('tweets/' .$tweet->id) }}" class="mb-0">
                @csrf
                @method('DELETE')

                <a href="{{ url('tweets/' .$tweet->id .'/edit') }}" class="dropdown-item">編集</a>
                <button type="submit" class="dropdown-item del-btn">削除</button>
              </form>
            </div>
          </div>
          @endif

          {{-- 自分が投稿したコメント機能 --}}
          <div class="mr-3 d-flex align-items-center">
            <a href="{{ url('tweets/' .$tweet->id) }}"><i class="far fa-comment fa-fw"></i></a>
            <p class="mb-0 text-secondary">{{ count($tweet->comments) }}</p>
          </div>
          {{-- コメント機能ここまで --}}

          <!-- 自分が投稿したいいね機能 -->
          <div class="d-flex align-items-center">
            @if (!in_array($user->id, array_column($tweet->favorites->toArray(), 'user_id'), TRUE))
            <form method="POST" action="{{ url('favorites/') }}" class="mb-0">
              @csrf

              <input type="hidden" name="tweet_id" value="{{ $tweet->id }}">
              <button type="submit" class="btn p-0 border-0 text-primary"><i class="far fa-heart fa-fw"></i></button>
            </form>
            @else
            <form method="POST"
              action="{{ url('favorites/' .array_column($tweet->favorites->toArray(), 'id', 'user_id')[$user->id]) }}"
              class="mb-0">
              @csrf
              @method('DELETE')

              <button type="submit" class="btn p-0 border-0 text-danger"><i class="fas fa-heart fa-fw"></i></button>
            </form>
            @endif
            <p class="mb-0 text-secondary">{{ count($tweet->favorites) }}</p>
          </div>
          <!-- いいねここまで -->
          {{-- ここまでが自分が投稿したところ --}}

        </div>
      </div>
    </div>
  </div>

  {{-- ここからがツイートに対しての返信機能 --}}
  <div class="row justify-content-center">
    <div class="col-md-8 mb-3">
      <ul class="list-group">
        @forelse ($comments as $comment)
        <li class="list-group-item">
          <div class="py-3 w-100 d-flex">
            <img src="{{ $comment->user->profile_image }}" class="rounded-circle" width="50" height="50">
            <div class="ml-2 d-flex flex-column">
              <p class="mb-0">{{ $comment->user->name }}</p>
              <a href="{{ url('users/' .$comment->user->id) }}"
                class="text-secondary">{{ $comment->user->screen_name }}</a>
            </div>
            <div class="d-flex justify-content-end flex-grow-1">
              <p class="mb-0 text-secondary">{{ $comment->created_at->format('Y-m-d H:i') }}</p>
            </div>
          </div>


          <div class="py-3">
            {!! nl2br(e($comment->text)) !!}
            {{-- コメントといいねの追加機能 --}}
            <div class="card-footer py-1 d-flex justify-content-end bg-white">
              @if ($tweet->user->id === Auth::user()->id)
              <div class="dropdown mr-3 d-flex align-items-center">
                <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false">
                  <i class="fas fa-ellipsis-v fa-fw"></i>
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <form method="POST" action="{{ url('tweets/' .$tweet->id) }}" class="mb-0">
                    @csrf
                    @method('DELETE')

                    <a href="{{ url('tweets/' .$tweet->id .'/edit') }}" class="dropdown-item">編集</a>
                    <button type="submit" class="dropdown-item del-btn">削除</button>
                  </form>
                </div>
              </div>
              @endif

              {{-- 自分が投稿したコメント機能 --}}
              <div class="mr-3 d-flex align-items-center">
                <a href="{{ url('tweets/' .$tweet->id) }}"><i class="far fa-comment fa-fw"></i></a>
                <p class="mb-0 text-secondary">{{ count($tweet->comments) }}</p>
              </div>
              {{-- コメント機能ここまで --}}

              <!-- 返信にいいね機能 -->
              {{-- @include('components.reply_like') --}}
              <span>
                <heart></heart>
              </span>
            </div>
          </div>
          {{-- ここまでが自分が投稿したところ --}}

        </li>
        @empty
        <li class="list-group-item">
          <p class="mb-0 text-secondary">コメントはまだありません。</p>
        </li>
        @endforelse
        <li class="list-group-item">
          <div class="py-3">
            <form method="POST" action="{{ route('comments.store') }}">
              @csrf

              {{-- ログインしたユーザー、つまり自分 --}}
              <div class="form-group row mb-0">
                <div class="col-md-12 p-3 w-100 d-flex">
                  <img src="{{  $user->profile_image }}" class="rounded-circle" width="50" height="50">
                  <div class="ml-2 d-flex flex-column">
                    <p class="mb-0">{{ $user->name }}</p>
                    <a href="{{ url('users/' .$user->id) }}" class="text-secondary">{{ $user->screen_name }}</a>
                  </div>
                </div>
                <div class="col-md-12">
                  <input type="hidden" name="tweet_id" value="{{ $tweet->id }}">
                  <textarea class="form-control @error('text') is-invalid @enderror" name="text" required
                    autocomplete="text" rows="4">{{ old('text') }}</textarea>

                  @error('text')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-12 text-right">
                  <p class="mb-4 text-danger">140文字以内</p>
                  <button type="submit" class="btn btn-primary">
                    ツイートする
                  </button>
                </div>
              </div>
            </form>

            {{-- {{ $tweet->user }} --}}
            {{ $tweet->favorites }}

            {{-- {{ $heartCount }} --}}
            {{-- {{ $comment->text }} --}}
            {{-- {{$user->id}} --}}
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
@endsection