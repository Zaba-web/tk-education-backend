<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TaskResults;
use App\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserTaskController extends Controller
{
    public function complete(Request $request){

        if($request->file('work') == null)
            return GetFormatedMessage("Помилка","Ви повинні обрати файл.","error");
        

        $taskId = $request->input('_sessTok'); // task id

        // check for early compliting
        
        $isTaskResultExist = TaskResults::where('task_id', $taskId)->where('user_id', Auth::user()->id)->get()->first();

        if($isTaskResultExist != null)
            return GetFormatedMessage("Помилка","Ви вже здавали це завдання.","error");
        

        // getting file from a request

        $work_file = $request->file('work');
        $extension = $work_file->extension();

        if($extension == "php" || $extension == "phtml")
            return GetFormatedMessage("Помилка","Не вірний формат файлу.","error"); 
        

        // get all meta data 

        $task = Task::find($taskId);
        $theme = $task->theme()->get()->first();
        $course = $theme->course()->get()->first();

        $isThematic = 0;

        if($task->is_themactic == "on")
            $isThematic = 1;
        

        // all students should have a personal folder to upload their works

        $path = 'public/uploads/'.Auth::user()->login;

        if(!File::exists($path))
            File::makeDirectory($path, $mode = 0777, true, true);
        

        File::makeDirectory($path."/".$task->id, $mode = 0777, true, true); // and every single work contained in own folder

        $work_file->storeAs($path."/".$task->id, $work_file->getClientOriginalName());

        // writing information about completed task in database

        $taskResult = new TaskResults();
        $taskResult->user_id = Auth::user()->id;
        $taskResult->task_id = $taskId;
        $taskResult->course_id = $course->id;
        $taskResult->is_thematic = $isThematic;
        $taskResult->link = asset('storage/uploads/'.Auth::user()->login.'/'.$task->id.'/'.$work_file->getClientOriginalName());
        $taskResult->group_id = Auth::user()->group()->get()->first()->id;

        return $taskResult->publish("Вашу роботу надіслано на перевірку.","Не вдалося надіслати роботу.");

    }

    public function check(Request $request, $id){
        $result = TaskResults::find($id);

        $result->checked = 1;
        $result->mark = $request->input('mark');
        $result->comment = $request->input('comment');

        return $result->publish("Роботу перевірено.","Не вдалося перевірити роботу.");
    }

    public function reject($id){
        $record = TaskResults::find($id);
        return $record->deleteRecord("Роботу виделно.", "Не вдалося видалити роботу.");
    }
}
