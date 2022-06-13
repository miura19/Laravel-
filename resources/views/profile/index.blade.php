@extends('layouts.app')
@section('content')

<h1 class="mt4">ユーザー一覧</h1>

<table class="table" style="background-color:white;">
    <thead style="background-color:#343a40; color:white;">
        <tr>
            <th scope="col">#</th>
            <th scope="col">名前</th>
            <th scope="col">email</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user) 
        <tr>
            <th scope="row">{{$user->id}}</th>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection