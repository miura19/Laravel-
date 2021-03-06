@extends('layouts.app')
@section('content')

<div class="container ml-auto col-12 col-md-10 col-lg-8" style="background-color:white;">
    <div class="row">
        <div class="col-md-10 mt-6 mx-auto">
            <div class="card-body">
                <h1 class="mt4">プロフィール編集</h1>
                <form method="post" action="{{route('profile.update', $user)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">お名前</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{old('name', $user->name)}}">
                    </div>
                    @if ($errors->has('name')) 
                        <div class="alert alert-danger mt-3">
                            {{ $errors->first('name') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="email">メールアドレス</label>
                        <input type="text" name="email" class="form-control" id="email" value="{{old('email', $user->email)}}">
                    </div>
                    @if ($errors->has('email')) 
                        <div class="alert alert-danger mt-3">
                            {{ $errors->first('email') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="avatar">アバター変更（サイズは1MBまで）</label>
                        <img src="{{asset('storage/avatar/'.($user->avatar??'user_default.jpg'))}}"
                        class="d-block rounded-circle mb-3" style="height:100px;width:100px;">
                        <div>
                            <input id="avatar" type="file" name="avatar">
                        </div>
                    </div>
                    @if ($errors->has('avatar')) 
                        <div class="alert alert-danger mt-3">
                            {{ $errors->first('avatar') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="password">パスワード(8文字以上）</label>
                        <input id="password" type="password" 
                        class="form-control" name="password" placeholder="パスワードを入力してください" 
                        required autocomplete="new-password">

                    </div>
                    @if ($errors->has('password')) 
                        <div class="alert alert-danger mt-3">
                            {{ $errors->first('password') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="password">パスワード再入力</label>
                        <input id="password-confirm" type="password" class="form-control" 
                        name="password_confirmation" placeholder="パスワードを再入力してください" 
                        required autocomplete="new-password">
                    </div>
                    @if ($errors->has('password_confirmation')) 
                        <div class="alert alert-danger mt-3">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif

                    <button type=”submit” class="btn btn-success">送信する</button>
                </form>
                @can('admin')
                <div class="mt-5">
                    <h4 class="mb-3">役割付与・削除（アドミンユーザーにのみ表示）</h4>
                    <table class="table" style="background-color:white;">
                        <thead style="background-color:#343a40; color:white;">
                            <tr>
                                <th scope="col-4" width="30%">役割</th>
                                <th scope="col-4" width="40%">付与</th>
                                <th scope="col-4" width="40%">削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>
                                    {{$role->name}}
                                </td>
                                <td>
                                    <form method="post" action="{{route('role.attach', $user)}}">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="role" value="{{$role->id}}">
                                        <button class="btn btn-primary"
                                            @if($user->roles->contains($role))
                                                disabled
                                            @endif
                                            >ロール追加
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="{{route('role.detach', $user)}}">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="role" value="{{$role->id}}">
                                        <button class="btn btn-danger"
                                            @if(!$user->roles->contains($role))
                                                disabled
                                            @endif
                                            >ロール削除
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endcan
            </div>
        </div>      
    </div>
</div>

@endsection