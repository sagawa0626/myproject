<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Family;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{

    public function index()
    {
        $users = User::where('family_id', '=', Auth::user()->family_id)->get();

        return view('posts.index', ['users' => $users]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request, Post $post)
    {
        $validator = Validator::make($request->all() , [
            'body' => 'required|max:255', 
            'image' => 'required']);

        if ($validator->fails())
        {
            return redirect()->back()->withEroors($validator->errors())->withInput();
        }

        $post = new Post;
        $form = $request->all();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::user()->id;

        if (isset($form['image'])) 
        {
            $path = $request->file('image')->store('public/image');
            $post->image_path = basename($path);
        } else {
            $post->image_path = null;
        }

        unset($form['_token']);
        unset($form['image']);

        $post->fill($form);
        $post->save(); 

        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $post_data = $post;
        $post_form = $request->all();
        if (isset($post_form['image'])) {
            $path = $request->file('image')->store('public/image/');
            $post_data->image_path = basename($path);
            unset($post_form['image']);
        }   elseif (isset($request->remove)) {
            $post_data->image_path = null;
            unset($post_form['remove']);
        }
        unset($post_form['_token']);
        $post_data->fill($post_form)->save();
       
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        
        return redirect()->route('posts.index');
    }

    public function like(Request $request, Post $post)
    {
        $post->likes()->detach($request->user()->id);
        $post->likes()->attach($request->user()->id);

        return [
            'id' => $post->id,
            'countLikes' => $post->count_likes,
        ];
    }

    public function unlike(Request $request, Post $post)
    {
        $post->likes()->detach($request->user()->id);

        return [
            'id' => $post->id,
            'countLikes' => $post->count_likes,
        ];
    }

    public function show()
    {
        $users = User::where('family_id', '=', Auth::user()->family_id)->get();

        return view('posts.show', ['users' => $users]);
    }
}
