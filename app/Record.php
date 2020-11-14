<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    public function publish($successMessage, $errorMessage){
        if($this->save()){
            return GetFormatedMessage("Створено", $successMessage, "success");
        }else{
            return GetFormatedMessage("Помилка", $errorMessage, "error");
        }
    }

    public function deleteRecord($successMessage, $errorMessage){
        if($this->delete()){
            return GetFormatedMessage("Видалено", $successMessage, "success");
        }else{
            return GetFormatedMessage("Помилка", $errorMessage, "error"); 
        }
    }

    public function saveChanges($successMessage, $errorMessage){
        if($this->save()){
            return GetFormatedMessage("Збережно", $successMessage, "success");
        }else{
            return GetFormatedMessage("Помилка", $errorMessage, "error");
        }
    }

}
