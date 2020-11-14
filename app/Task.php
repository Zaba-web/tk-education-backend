<?php

namespace App;

use App\Record;

class Task extends Record
{
    public function theme(){
        return $this->belongsTo('App\Theme', 'theme_id', 'id');
    }
}
