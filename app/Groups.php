<?php

namespace App;

use App\Record;

class Groups extends Record
{
    public function users(){
        return $this->hasMany('App\User', 'group_id');
    }

    public static function list(){
        $groups = Groups::all();

        foreach($groups as $group){
            $group['confirmed_students'] = $group
            ->users()
            ->where('confirmed',1)
            ->where('access_level',1)
            ->count();

            $group['unconfirmed_students'] = $group
            ->users()
            ->where('confirmed',0)
            ->where('access_level',1)
            ->count();
        }

        return json_encode($groups);
    }

    public static function getAllStudents($group_id) {
        $students = Groups::find($group_id)->users()->where('access_level',1)->get();

        foreach($students as $student)
            $student['online'] = $student->isOnline();
        
        return $students;
    }

    public static function singleGroupInformation($id){
        return json_encode(Groups::where('id', $id)->first());
    }
}