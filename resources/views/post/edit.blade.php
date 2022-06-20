@extends('layouts.app')
@section('content')
    
<div class="row">
    <div class="col-md-10 mt-6">
        <div class="card-body">
            <h1 class="mt4">編集するよっっ！///</h1>
            <form method="post" action="{{ route('post.update',$post) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">件名</label>
                    <input type="text" name="title" value="{{ old('title',$post->title) }}" class="form-control" id="title" placeholder="Enter Title">
                </div>
                @if ($errors->has('title')) 
                    <div class="alert alert-danger mt-3">
                        {{ $errors->first('title') }}
                    </div>
                @endif

                <div class="form-group">
                    <label for="body">本文</label>
                    <textarea name="body" class="form-control" id="body" cols="30" rows="10">{{ old('body',$post->body)}}</textarea>
                </div>
                @if ($errors->has('body')) 
                    <div class="alert alert-danger mt-3">
                        {{ $errors->first('body') }}
                    </div>
                @endif
                
                <div class="form-group">
                    <div class="mt-3">
                        @if($post->image)
                        <img src="{{ asset('storage/images/'.$post->image)}}" 
                        class="img-fluid rmx-auto d-block" style="height:200px;">
                        @endif
                    </div>
                    <label for="image">画像（1MBまで）</label>
                    <div class="col-md-6 mt-3">
                        <input id="image" type="file" name="image">
                    </div>
                </div>
                @if ($errors->has('image')) 
                    <div class="alert alert-danger mt-3">
                        {{ $errors->first('image') }}
                    </div>
                @endif
 
                <button type="submit" class="btn btn-success">送信する </button>
            </form>
        </div>
    </div>
</div>
@endsection