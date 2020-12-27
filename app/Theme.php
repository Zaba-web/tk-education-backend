<?php

namespace App;

use App\Record;

class Theme extends Record
{
    public function course(){
        return $this->belongsTo('App\Course', 'course_id', 'id');
    }

    public function tasks(){
        return $this->hasMany('App\Task', 'theme_id');
    }

    public function isThemeAvailable($groupId){
        $access = Accessability::where('theme_id', $this->id)->where('group_id', $groupId)->get()->first();
        
        if(isset($access)){
            return true;
        }

        return false;
    }

    public function middleMark($user_id){
        $middleMark = 0;
        $count = 0;
        $tasks = Task::select('id')->where('theme_id',$this->id)->where('is_themactic', "on")->get();
        foreach($tasks as $task){
            $result = TaskResults::where('user_id', $user_id)->where('task_id', $task->id)->get();
            foreach($result as $work){
                $count++;
                $middleMark += $work->mark;
            }
        }
        if($count != 0){
            return $middleMark/$count;
        }else{
            return 0;
        }
    }

    public function getTaskList(){
        return Task::getTasksByThemeId($this->id);
    }

    public static function list($id){
        $themes = Course::find($id)->themes()->get();

        foreach($themes as $theme){
            $theme["taskCount"] = $theme->tasks()->count();
        }

        return json_encode($themes);
    }
}
