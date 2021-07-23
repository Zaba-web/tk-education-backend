<?php

namespace App;

use App\Record;

class Course extends Record 
{
    public function themes(){
        return $this->hasMany('App\Theme', 'course_id');
    }

    public function getTasks(){
        $themes = $this->themes()->get();
        $checkableTaskList = [];

        foreach($themes as $theme){
            $tasks = $theme->tasks()
            ->select('check_mode','id','title','is_draft','is_themactic')
            ->orderBy('theme_id','asc')
            ->get();
            
            foreach($tasks as $task){
                if($task->check_mode > 1){
                    $task['theme_name'] = $theme->title;
                    $task['course_id'] = $this->id;
                    array_push($checkableTaskList, $task);
                }
            }
        }

        return $checkableTaskList;
    }

    function getProgress(){
        $results = TaskResults::where('course_id', $this->id)->where("checked", 1)->count();
        $taskCount = count($this->getTasks());

        if($taskCount != 0 && $results != 0)
            return round($results / $taskCount * 100);
        

        return 0;
    }

    public static function list(){
        $courses = Course::all();

        foreach($courses as $course)
            $course["themeCount"] = $course->themes()->count();
        
        return json_encode($courses);
    }

    public static function single($id){
        return Course::where('id', $id)->get();
    }
}
