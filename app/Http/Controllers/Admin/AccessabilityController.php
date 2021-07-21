<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Accessability;
use App\Groups;
use App\Theme;

class AccessabilityController extends Controller
{
    public function create(Request $request){
        $isAccessSet = Accessability::where("group_id", $request->input('group_id'))
        ->where("theme_id", $request->input('theme_id'))
        ->count();
        
        if($isAccessSet != 0)
            return GetFormatedMessage("Попередження","Ця група вже має доступ до даної теми.","informative");
        

        $access = new Accessability();
        $access->group_id = $request->input('group_id');
        $access->group_name = $request->input('group_name');
        $access->theme_id = $request->input('theme_id');
        $access->theme_title = $request->input('theme_title');

        return $access->publish("Ви успішно надали доступ до даної теми.", "Не вдалося надати доступ.");
    }

    public function getGroupAccess($id){
        return Accessability::where('theme_id', $id)->get();
    }
}
