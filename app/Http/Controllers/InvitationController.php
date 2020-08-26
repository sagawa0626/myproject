<?php

namespace App\Http\Controllers;

use App\Invitation;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\support\Str;
use Auth;

class InvitationController extends Controller
{
    public function index()
    {
        return view('invitation.create');
    }

    public function create(Request $request)
    {
        // $tokenはランダムにHash化された文字を40文字の指定定義
        $token = Str::random(40);
        
        // invitationインスタンスを作成
        // emailは$requestの中のemail
        // tokenはランダムで生成された文字
        // family_idは現在ログインしているユーザーのfamily_id
        
        $invitation = new Invitation;
        $invitation->email = $request->email;
        $invitation->token = Hash::make($token);
        $invitation->family_id = Auth::user()->family_id;
        $invitation->save();

        // invitationのstore.blade.phpに変数$tokenと$emailを所持した状態で返す
        return view('invitation.store', ['token' => $token, 'email' => $request->email]);
    }

    public function recieve(string $token)
    {
        $invitation = Invitation::get();

        // 送られてきたtokenと$invitationにあるtokenが一致するかチェック
        // 一致していたらinvitationのrecieve.blade.phpに変数$tokenを所持し返す
        foreach ($invitation as $i) {
            if (Hash::check($token, $i->token)) {
                return view('invitation.recieve', ['token' => $token]);
            }
        }
    }

    public function register(Request $request)
    {
        // 変数$invitationにregisterからに送られてきたemailと合致しているInvitationテーブルの
        // 中のデータをgetして取り出す
        // もし送られてきた$requestの中のtokenとinvitationテーブルにあるtokenが一致していたら
        // 新しいUserインスタンスを作成しユーザー登録を行う
        // その後$iに入っていたカラムを削除

        $invitation = Invitation::where('email', $request->email)->get();
        foreach ($invitation as $i) {
            if (Hash::check($request->token, $i->token)) {
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->family_id = $i->family_id;
                $user->password = Hash::make($request->password);
                $user->save();

                $i->where('email', $i->email)->delete();
                
                // 認証処理をパスして、現在のセッションにログインとしてユーザーを保持します
                Auth::login($user);

                return redirect('/')->with('flash_message', '招待を承諾しました');
            }
        }
    }
}
