{{-- 返信のいいね機能 --}}
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