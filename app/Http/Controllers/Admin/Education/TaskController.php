<?php

namespace App\Http\Controllers\Admin\Education;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;
use App\Theme;

class TaskController extends Controller
{
    public function create(Request $request){
        $task = new Task();

        $task->title = $request->input('title');
        $task->theme_id = $request->input('theme_id');
        $task->check_mode = $request->input('check_mode');
        $task->is_draft = $request->input('publication_setting');
        $task->is_themactic = $request->input('summary_work');
        $task->theory = $request->input('theory');
        $task->task = $request->input('task');

        return $task->publish("Завдання успішно створено.", "Не вдалося створити завдання.");

    }

    public function list($id){
        $task = Task::getTasksByThemeId($id);
        return json_encode($task);
    }

    public function delete($id){
        $task = Task::find($id);
        return $task->deleteRecord("Завдання успішно видалено.", "Не вдалося видалити задвання.");
    }

    public function getSingleTask($id){
        return Task::find($id);
    }

    public function update(Request $request, $id){
        $task = Task::find($id);

        if($task == null){
            return GetFormatedMessage("Помилка","Не вдалося знайти задвання.","error");
        }

        $task->title = $request->input('title');
        $task->check_mode = $request->input('check_mode');
        $task->is_draft = $request->input('publication_setting');
        $task->is_themactic = $request->input('summary_work');
        $task->theory = $request->input('theory');
        $task->task = $request->input('task');

        return $task->saveChanges("Завдання успішно оновлено.", "Не вдалося оновити завдання.");
    }
}
