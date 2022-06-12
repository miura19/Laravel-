@extends('layouts.app')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <div class="text-muted small mr-3"> 
            {{$post->user->name}}
        </div>
        <h4>{{$post->title}}</h4>
        <span class="ml-auto">
            <a href="{{route('post.edit', $post)}}"><button class="btn btn-primary">編集</button></a>
        </span>
        <span class="ml-2">
        <form method="post" action="{{route('post.destroy', $post)}}">
            @csrf
            <button type="submit" class="btn btn-danger" onClick="return confirm('本当に削除しますか？');">削除</button>
        </form>
        </span>
    </div>
    <div class="card-body">
        <p class="card-text">
            {{$post->body}}
        </p>
        @if($post->image)
            <img src="{{ asset('storage/images/'.$post->image) }}" alt=""  class="img-fluid mx-auto d-block" style="height:300px;">
        @endif
    </div>
    <div class="card-footer">
        <span class="mr-2 float-right">
            投稿日時 {{$post->created_at->diffForHumans()}}
        </span>
    </div>
</div>

<hr>
@foreach ($post->comments as $comment)
<div class="card mb-4">
    
    <div class="card-header">
        {{$comment->user->name}}
    </div>
    <div class="card-body">
        {{$comment->body}}
    </div>
    <div class="card-footer">
        <span class="mr-2 float-right">
            投稿日時 {{$comment->created_at->diffForHumans()}}
        </span>
    </div>
</div>
@endforeach

@if ($errors->has('comment')) 
    <div class="alert alert-danger mt-3">
        {{ $errors->first('comment') }}
    </div>
@endif
{{-- コメント投稿用フォーム --}}
<div class="card mb-4">
    <form method="post" action="{{route('comment.store')}}">
        @csrf
        <input type="hidden" name='post_id' value="{{$post->id}}">
        <div class="form-group">
            <textarea name="comment" class="form-control" id="comment" cols="30" rows="5" 
            placeholder="コメントを入力する">{{old('comment')}}</textarea>
        </div>
        <div class="form-group">
        <button class="btn btn-success float-right mb-3 mr-3 mt-3">コメントする</button>
        </div>
    </form>
</div>  
<script>
    @if (session('store_comment_success'))
        $(function () {
            toastr.success('{{ session('store_comment_success') }}');
        });
    @endif
</script>
@endsection