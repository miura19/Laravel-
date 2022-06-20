<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\storeComment;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(storeComment $request)
    {
        $comment = Comment::create([
            'body' => $request->input('comment'),
            'user_id' => auth()->user()->id,
            'post_id' => $request->post_id
        ]);
        return back()->with([
            'store_comment_success' => 'コメントを投稿したよっっ！///'
        ]);
    }
}
