<?php

namespace App\Http\Controllers\Admin\Education;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use App\Accessability;

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

    public function getSingleItem($id){
        return Course::single($id);
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

    public function getFullData($courseId, Request $request) {
        $course = Course::find($courseId);
        $themes = $course->themes()->get();

        $groupId = $request->user()->group_id;
        $theme_ids;

        foreach($themes as $theme)
            $theme_ids[] = $theme->id;

        $themesAccess = Accessability::isGroupHasAccessToTheme($groupId, $theme_ids);

        $result = [
            "courseName" => $course->name,
            "themes" => []
        ]; 

        foreach($themes as $theme){
            if(isset($themesAccess[$theme->id])) {
                $result["themes"][$theme->id]["tasks"] = $theme->tasks()->get(['id', 'title', 'is_draft', 'is_themactic']);
                $result["themes"][$theme->id]["avgMark"] = $theme->middleMark($request->user()->id);
            } else {
                $result["themes"][$theme->id] = null;
            }
            $result["themes"][$theme->id]["title"] = $theme->title;
        }

        return response($result);
    }
}
