<?php

namespace App;

use App\Record;

class Task extends Record
{
    public function theme(){
        return $this->belongsTo('App\Theme', 'theme_id', 'id');
    }

    public static function getTasksByThemeId($theme_id){
        return Task::select('id', 'title', 'theme_id', 'check_mode', 'is_themactic', 'is_draft', 'created_at', 'updated_at')->where('theme_id', $theme_id)->get();
    }
}
