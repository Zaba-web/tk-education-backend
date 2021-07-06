<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function registerUser(Request $request){
        $this->validate($request, [
            "login" => "required|min:3",
            "email" => "required|min:6",
            "password" => "required|min:6|confirmed",
            "name" => "required|min:4",
            "group" => "required|gt:0"
        ]);

        $user = $this->createUser($request);

        if($user->save())
            return json_encode( ["registered" => true] );
        
    }

    private function createUser(Request $request){
        $user = new User();

        $user->login = $request->input('login');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->name = $request->input('name');
        $user->group_id = $request->input('group');

        return $user;
    }
}
