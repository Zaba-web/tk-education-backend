<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Groups;
use App\User;

class GroupController extends Controller
{
    function list(){
        return Groups::list();
    }

    function singleGroupData($id){
        return Groups::singleGroupInformation($id);
    }

    function getAllStudents($group_id){
        return json_encode(Groups::getAllStudents($group_id));
    }

    public function create(Request $request){
        $group = new Groups();
        $group->name = $request->input('group-name');
        $group->master_vn = $request->input('master-name');

        return $group->publish("Групу ".$request->input('group-name')." успішно створено.", "Не вдалося створити групу ".$request->input('group-name').".");
    }

    public function update(Request $request, $id){
        $group = Groups::find($id);

        $group->name = $request->input('group-name');
        $group->master_vn = $request->input('master-name');

        return $group->saveChanges("Групу ".$request->input('group-name')." успішно оновлено.", "Не вдалося оновити групу ".$request->input('group-name').".");
    }

    public function setup(Request $request, $id){
        $group = Groups::find($id);
        
        $group->day_vn = $request->input('day');
        $group->order_vn = $request->input('order');

        return $group->saveChanges("Групу ".$request->input('group-name')." успішно оновлено.", "Не вдалося оновити групу ".$request->input('group-name').".");
    }

    public function delete($id){
        $group = Groups::find($id);
        return $group->deleteRecord("Видалення групи пройшло успішно.", "Не вдалося видалити групу.");
    }

}
