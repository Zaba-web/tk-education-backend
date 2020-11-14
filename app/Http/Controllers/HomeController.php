<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Groups;

class HomeController extends Controller
{
    public function getHome(){
        $groups = Groups::all();
        return view('home')->with('groups',$groups);
    }

    public function getInfo(){
        $msg = [
            "title" => "Помилка",
            "text" => "Ви не вповноважені переглядати даний розділ.",
            "url" => "/"
        ];
        return view('home_massage')->with('message', $msg);
    }
}
