{{-- {{ $tweets }} --}}
@foreach ($tweets as $tweet)
    <p>
     {{ $tweet->text }}
    </p>
@endforeach