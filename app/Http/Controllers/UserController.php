<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUserAccessLevel(Request $request){
        return $request->user()->access_level;
    }
    
    public function accessError(Request $request){
        return 0;
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();
        return json_encode(["success" => true]);
    }

    public function getAllUserData(Request $request){
        return json_encode($request->user());
    }
}
