<?php

namespace App\Http\Controllers\Admin\Education;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;

class CourseController extends Controller
{
    public function create(Request $request){
        $course = new Course();

        $course->name  = $request->input('name');
        $course->description  = $request->input('description');

        return $course->publish("Новий розділ успішно створено.", "Не вдалося створити новий розділ.");
    }

    public function list(){
        return Course::list();
    }
    
    public function delete($id){
        $course = Course::find($id);
        return $course->deleteRecord("Видалення розділу пройшло успішно.", "Не вдалося видалити розділ.");
    }

    public function update(Request $request, $id){
        $course = Course::find($id);

        $course->name = $request->input('name');
        $course->description = $request->input('description');

        return $course->saveChanges("Розділ оновлено.", "Не вдалося оновити розділ.");
    }
}
