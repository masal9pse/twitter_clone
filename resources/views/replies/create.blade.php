@extends('layouts.app')

{{-- ここからが自分自身が投稿したところ --}}
@section('content')
<form action="{{ route('replies.store') }}" method="post">
    {{ csrf_field() }}
    <div class="form-group row mb-0">
        <div class="col-md-12 text-right">
            <p class="mb-4 text-danger">140文字以内</p>
            <button type="submit" class="btn btn-primary">
                コメントする
            </button>
        </div>
    </div>
</form>
@endsection