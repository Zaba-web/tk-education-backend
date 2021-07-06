<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        $login = $request->input('login');
        $password = $request->input('password');
        $user = User::where('login', $login)->first();

        if(!$this->ifUserExists($user) || !$this->ifUserConfirmed($user))
            return json_encode(["error" => true, "details" => "Профіль не існує \ не підтверджено"]);

        if(Auth::attempt($request->only(['login', 'password']))){
            $accessToken = Auth::user()->createToken('authToken')->accessToken;     
            return response(['user' => Auth::user(), 'access_token' => $accessToken]);
        }

        return json_encode(["error" => true, "details" => "Не вдалося увійти"]);
    }

    private function ifUserExists($user){
        return $user != null;
    }

    private function ifUserConfirmed($user){
        return $user->confirmed != 0;
    }
}
