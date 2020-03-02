{{-- {{ $tweets }} --}}
<a href="{{ route('tweets.index') }}">一覧</a>
<a href="{{ route('tweets.create') }}">投稿する</a>
{{-- <a href="{{ route('tweets.') }} "></a> --}}
@foreach ($tweets as $tweet)
    <p>
     {{ $tweet->text }}
    </p>
@endforeach