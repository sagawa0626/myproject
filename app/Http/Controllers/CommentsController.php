<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use Auth;
use Validator;
use App\User;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        return redirect()->route('posts.index');
    }

    public function destory(Request $request)
    {
        $comment = Comment::find($request->comment_id);
        $comment->delete();
        return redirect()->route('posts.index');
    }
}
