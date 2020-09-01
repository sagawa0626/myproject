<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($user_id)
    {
        $user = User::where('id', $user_id)->firstOrFail();

        return view('users/show', ['user' => $user,]);
    }

    public function edit()
    {
        $user = Auth::user();

        return view('users/edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->user_name;
        $user->relationship = $request->user_relationship;

        if($request->user_profile_photo !=null){
            $image = $request->user_profile_photo;
            $path = Storage::disk('s3')->putFileAs('/profile_images', $image, $user->id.'.jpg', 'public');
            $user->profile_photo = Storage::disk('s3')->url($path);
        }

        $user->save();

        return redirect('/users/'.$request->id);
    }
}
