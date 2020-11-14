<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Groups;
use App\Course;
use App\Task;
use App\TaskResults;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function home(){
        $group = Auth::user()->group()->get();
        
        $activity = TaskResults::where('user_id', Auth::user()->id)
        ->orderBy('id','desc')
        ->take(10)
        ->get();

        $courses = Course::select('id', 'name')->get();

        $data = [
            "group" => $group,
            "activity" => $activity,
            "courses" => $courses
        ];

        return view('dashboard.home')->with('data', $data);
    }

    public function study(){
        $courses = Course::all();
        foreach($courses as $course){
            $course["theme_count"] = $course->themes()->count();
        }
        return view('dashboard.study.main')->with('courses', $courses);
    }

    public function course($id){
        $course = Course::find($id);

        if($course == null){
            return redirect()->back();
        }

        $data = [
            "course" => $course
        ];

        return view('dashboard.study.course')->with("data",$data);
    }

    public function task($id){
        $task = Task::find($id);
        return view('dashboard.study.task')->with("task",$task);
    }

    public function settings(){
        return view('dashboard.settings');
    }

    public function activity(){
        $works = TaskResults::where('user_id',Auth::user()->id)->orderBy('mark','desc')->get();
        return view('dashboard.activity')->with('works', $works);
    }
}
