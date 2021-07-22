<?php

namespace App;

use App\Record;

class Accessability extends Record
{
    public static function isGroupHasAccessToTheme($group_id, $theme_ids) {
        $raw = Accessability::where('group_id', $group_id)->get();
        $result;

        foreach($raw as $accessability) {
            if(in_array($accessability->theme_id, $theme_ids)) {
                $result[$accessability->theme_id] = true;
            }
        }

        return $result;
    }
}
