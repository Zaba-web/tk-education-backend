<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Factory;
use App\User;
use App\Groups;
use App\Course;
use App\Theme;
use App\Task;
use App\Accessability;
use App\TaskResults;

class AdminController extends Controller
{
    public function getHome(){
        $studentsResult = [
            "active" => User::where('access_level', 1)->where('confirmed', 1)->count(),
            "unactive" => User::where('access_level', 1)->where('confirmed', 0)->count(),
        ];
        return view('Admin.home')->with("students", $studentsResult);
    }
    
    public function getGroupsMain(){
        return view('Admin.groups.main');
    }

    public function getGroupsCreate(){
        return view('Admin.groups.create');
    }

    public function getGroupsEdit($id){
        $group = Groups::find($id);

        if($group != null){
            return view('Admin.groups.edit')->with('group', $group);
        }

        return redirect()->back();

    }

    public function getGroupsManage($id){
        $group = Groups::find($id);

        if($group != null){
            return view('Admin.groups.manage')->with('group', $group);
        }

        return redirect()->back();
    }

    public function getEducationMain(){
        return view('Admin.education.main');
    }

    public function getCreateCourse(){
        return view('Admin.education.course.create');
    }

    public function getCourseManage($id){
        $course = Course::find($id);

        if($course != null){
            return view('Admin.education.course.manage')->with('course', $course);
        }
        return redirect()->back();
    }

    public function getCreateTheme($id){
        $courses = Course::find($id);

        if($courses != null){
            $data = [
                "course" => $courses,
                "id" => $id
            ];
    
            return view('Admin.education.theme.create')->with('data',$data);
        }
        return redirect()->back();
    }

    public function getEditCourse($id){
        $course = Course::find($id);
        if($course != null){
            return view('Admin.education.course.edit')->with('course', $course);
        }
        return redirect()->back();
    }
    
    public function getEditTheme($id){
        $theme = Theme::find($id);

        if($theme != null){
            return view('Admin.education.theme.edit')->with('theme', $theme);
        }
        return redirect()->back();
    }

    public function getManageTheme($id){
        $theme = Theme::find($id);

        $accesses = Accessability::where('theme_id', $id)->get();

        $data = [
            "theme" => $theme,
            "access" => $accesses
        ];

        if($theme != null){
            return view('Admin.education.theme.manage')->with('data', $data);
        }
        return redirect()->back();
    }

    public function getCreateTask($id){
        $theme = Theme::find($id);

        if($theme != null){
            return view('Admin.education.task.create')->with('theme', $theme);
        }

        return redirect()->back();
    }

    public function uploadImage(Request $request){
        $funcNum = $request->input('CKEditorFuncNum');

        $this->validate($request,[
            'upload' => 'required|image'
        ]);

        $image = $request->file('upload');
        $image->store('public/uploads');
        $url = asset('storage/uploads/'.$image->hashName());

        return response(
            "<script>
                window.parent.CKEDITOR.tools.callFunction({$funcNum}, '{$url}', 'Зображення завантажено');
            </script>"
        );
    }

    public function getEditTask($id){
        $task = Task::find($id);

        if($task != null){
            return view('Admin.education.task.edit')->with('task', $task);
        }

        return redirect()->back();
    }

    public function getViewTask($id){
        $task = Task::find($id);

        if($task != null){
            return view('Admin.education.task.view')->with('task', $task);
        }

        return redirect()->back();
    }

    public function getUsersMain(){
        return view('Admin.users.main');
    }

    public function getCheckMain(){
        $courses = Course::all();
        return view('Admin.check.main')->with('courses',$courses);
    }

    public function getCheckCourse($id){
        $course = Course::find($id);
        $tasks = $course->getTasks();
        return view('Admin.check.tasks')->with('tasks',$tasks);
    }

    public function getCheckWorks($courseId, $taskId){
        $results = TaskResults::where('course_id', $courseId)->where('task_id', $taskId)->where('checked', 0)->orderBy('group_id', 'desc')->get();
        $checked = TaskResults::where('course_id', $courseId)->where('task_id', $taskId)->where('checked', 1)->orderBy('group_id', 'desc')->get();

        $task = Task::find($taskId)->select('title')->get()->first();

        $data = [
            "uncheked" => $results,
            "checked" => $checked,
            "task" => $task
        ];

        return view('Admin.check.works')->with('data', $data);
    }

    public function getConcreteWork($id){
        $result = TaskResults::find($id);
        return view('Admin.check.concrete')->with('result',$result);
    }

}
