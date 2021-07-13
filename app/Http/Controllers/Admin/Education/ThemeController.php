<?php

namespace App\Http\Controllers\Admin\Education;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Theme;
use App\Course;


class ThemeController extends Controller
{
    function create(Request $request){
        $theme = new Theme();
        
        $theme->title  = $request->input('name');
        $theme->course_id  = $request->input('course_id');

        return $theme->publish("Тему успішно створено.", "Не вдалося створити нову тему.");
    }

    public function delete($id){
        $theme = Theme::find($id);
        return $theme->deleteRecord("Тему успішно видалено.", "Не вдалося видалити тему.");
    }

    public function list($id){
        return Theme::list($id);
    }

    public function update(Request $request, $id){
        $theme = Theme::find($id);
        $theme->title = $request->input('name');

        return $theme->saveChanges("Тему успішно оновлено.", "Не вдалося оновити тему.");
    }

}

