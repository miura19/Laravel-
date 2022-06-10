<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\storePost;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storePost $request)
    {
        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;

        if (request('image') !== null){
            $original =  request()->file('image')->getClientOriginalName();
            //日時追加
            $img_name = date('Ymd_His'). "_" . $original;
            request()->file('image')->storeAs('public/images',$img_name);
            $post->image = $img_name;
        }
        $post->save();
        return redirect()->route('home')->with([
            'store_success' => '投稿が成功したよっっ！///'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(storePost $request, Post $post)
    {
        $post->title = $request->input('title');
        $post->body = $request->input('body');

        if (request('image') !== null){
            $original =  request()->file('image')->getClientOriginalName();
            //日時追加
            $img_name = date('Ymd_His'). "_" . $original;
            request()->file('image')->storeAs('public/images',$img_name);
            $post->image = $img_name;
        }
        $post->save();
        return back()->with([
            'update_success' => '編集が成功したよっっ！///'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('home')->with([
            'deleted_success' => '削除が成功したよっっ！///'
        ]);
    }
}
