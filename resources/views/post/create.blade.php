@extends('layouts.app')
@section('content')
    
<div class="row">
    <div class="col-md-10 mt-6">
        <div class="card-body">
            {{-- @if (session('store_success'))
                <div class="flash_message bg-success text-center py-3 my-0">
                    {{ session('store_success') }}
                </div>
            @endif --}}
            <h1 class="mt4">新規投稿</h1>
            <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">件名</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title">
                </div>

                <div class="form-group">
                    <label for="body">本文</label>
                    <textarea name="body" class="form-control" id="body" cols="30" rows="10"></textarea>
                </div>

                <div class="form-group">
                    <label for="image">画像 </label>
                    <div class="col-md-6">
                        <input id="image" type="file" name="image">
                    </div>
                </div>

                <button type="submit" class="btn btn-success">送信する </button>
            </form>
        </div>
    </div>
</div>
<script>
    @if (session('store_success'))
        $(function () {
            toastr.success('{{ session('store_success') }}');
        });
    @endif
</script>
@endsection