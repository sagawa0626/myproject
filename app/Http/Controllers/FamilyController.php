<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Family;
use App\User;
use Auth;
use Validator;

class FamilyController extends Controller
{
    public function index()
    {
        $families = Family::where('id', Auth::user()->family_id)->get();
        
        // familiesのuser情報のemailと現在ログイン中のemailが一致していれば
        // 招待ボタンを出現させる
        $isHost = false;
        if(isset($families, $families[0]->users[0]) && $families[0]->users[0]->email === Auth::user()->email) {
            $isHost = true;
        }

        return view('families/index', ['families' => $families, 'isHost' => $isHost]);
    }

    public function create()
    {
        return view('families.create');
    }

    public function store(Request $request)
    {
        $families = new Family;
        $families->family_name = $request->family_name;
        $families->family_password = $request->family_password;
        $families->save();

        $user = User::find(Auth::id());
        $user->family_id = $families->id;
        $user->save();
        
        return redirect('/');
    }
}
