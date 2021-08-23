<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TaskResults;
use App\Task;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserTaskController extends Controller
{
    public function complete(Request $request){

        if($request->file('work') == null)
            return GetFormatedMessage("Помилка","Ви повинні обрати файл.","error");
        

        $taskId = $request->input('_sessTok'); // task id
        $user = $request->user();
        // check for early compliting
        
        $isTaskResultExist = TaskResults::where('task_id', $taskId)->where('user_id', $user->id)->get()->first();

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

        $path = 'public/uploads/'.$user->login;

        if(!File::exists($path))
            File::makeDirectory($path, $mode = 0777, true, true);
        

        File::makeDirectory($path."/".$task->id, $mode = 0777, true, true); // and every single work contained in own folder

        $work_file->storeAs($path."/".$task->id, $work_file->getClientOriginalName());

        // writing information about completed task in database

        $taskResult = new TaskResults();
        $taskResult->user_id = $user->id;
        $taskResult->task_id = $taskId;
        $taskResult->course_id = $course->id;
        $taskResult->is_thematic = $isThematic;
        $taskResult->link = asset('storage/uploads/'.Auth::user()->login.'/'.$task->id.'/'.$work_file->getClientOriginalName());
        $taskResult->group_id = $user->group()->get()->first()->id;

        return $taskResult->publish("Вашу роботу надіслано на перевірку.","Не вдалося надіслати роботу.");

    }

    public function activity(Request $request, $count = -1){

        if($count == -1)
            $works = TaskResults::where('user_id', $request->user()->id)->get();
        else 
            $works = TaskResults::where('user_id', $request->user()->id)->take($count)->get();
        
        $result = ["user" => $request->user()->name];

        foreach($works as $work) {
            $result["works"][$work->id]["task"] = Task::where('id', $work->task_id)->first()->title;
            $result["works"][$work->id]["date"] = str_replace("000000Z", "", $work->created_at);
            $result["works"][$work->id]["checked"] = $work->checked;
            $result["works"][$work->id]["mark"] = $work->mark;
            $result["works"][$work->id]["comment"] = $work->comment;
        }

        return response($result);
    }

    public function single($id) {
        $result = TaskResults::join('tasks', 'task_results.task_id', '=', 'tasks.id')
        ->join('users', 'task_results.user_id', '=', 'users.id')
        ->select('task_results.*', 'tasks.title', 'tasks.is_themactic', 'tasks.task', 'users.name as userName')
        ->where('task_results.id', $id)
        ->first();

        return response($result);
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

    public function getWorksToCheck($courseId, $groupId, $userId = null) {
        $result = User::join('groups', 'users.group_id', '=', 'groups.id')
        ->join('task_results', 'users.id', '=', 'task_results.user_id')
        ->join('tasks', 'task_results.task_id', '=', 'tasks.id')
        ->select('task_results.*', 
                 'users.name as userName', 
                 'groups.name as groupName',
                 'tasks.title as taskName');

        if($userId != null)
            $result->where('task_results.user_id', $userId);
        else
            $result->where([['task_results.course_id', '=', $courseId], ['task_results.group_id', '=', $groupId]]);

        return response($result->get());
    }
}
