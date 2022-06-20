@extends('layouts.app')
@section('content')

{{-- 送信後のメッセージ表示 --}}
@if(session('store_contact_success'))
<div class="alert alert-success">{{session('store_contact_success')}}</div>
@endif

<div class="row">
    <div class="col-10 col-md-8 col-lg-6 mx-auto mt-6">
        <div class="card-body">
            <h1 class="mt4  mb-3">お問い合わせ</h1>
            <form method="post" action="{{route('contact.store')}}">
            @csrf
                <div class="form-group">
                    <label for="title">件名</label>
                    <input type="text" name="title" 
                    class="form-control" id="title" value="{{old('title')}}" 
                    placeholder="Enter Title">
                </div>
                @if ($errors->has('title')) 
                    <div class="alert alert-danger mt-3">
                        {{ $errors->first('title') }}
                    </div>
                @endif

                <div class="form-group">
                    <label for="body">本文</label>
                    <textarea name="body" 
                    class="form-control" id="body" cols="30" rows="10">{{old('body')}}</textarea>
                </div>
                @if ($errors->has('body')) 
                    <div class="alert alert-danger mt-3">
                        {{ $errors->first('body') }}
                    </div>
                @endif

                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" 
                    class="form-control" id="email" value="{{old('email')}}" 
                    placeholder="email">
                </div>
                @if ($errors->has('email')) 
                    <div class="alert alert-danger mt-3">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <button type="submit" class="btn btn-success">送信する</button>
            </form>
        </div>
    </div>
</div>
@endsection