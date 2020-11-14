<?php
    function GetFormatedMessage($title, $text, $type){
        $response = [
            "title"=>$title,
            "msg"=>$text,
            "type"=>$type
        ]; 
        return json_encode($response);
    }

?>