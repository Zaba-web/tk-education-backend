<?php

namespace App;

use App\Record;

class TaskResults extends Record
{
    public function getGroup(){
        $group = Groups::where('id',$this->group_id)->select('name')->first();
        return $group->name;
    }

    public function getStudentName(){
        $user = User::where('id',$this->user_id)->select('name')->first();
        return $user->name;
    }

    public function getFullTaskName(){
        $result = "";
        $course = Course::find($this->course_id)->select('name')->get()->first();
        $task = Task::find($this->task_id)->select('title')->get()->first();

        $result = $course->name . " - " . $task->title;

        return $result;
    }
}
