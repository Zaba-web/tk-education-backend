<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function delete($id){
        $user = User::find($id);

        if($user->delete())
            return GetFormatedMessage("Виделано","Видалення користувача пройшло успішно.","success");
        else
            return GetFormatedMessage("Помилка","Не вдалося видалити користувача.","error"); 
    }

    public function confirm(Request $request, $id){
        if($request->input('student_number') == null)
            return GetFormatedMessage("Помилка","Вкажіть номер користувача.","error"); 

        $user = User::find($id);
        $user->student_number = $request->input('student_number');
        $user->subgroup = $request->input('subgroup');
        $user->confirmed = 1;

        if($user->save())
            return GetFormatedMessage("Підтверджено","Користувача успішно підтверджено як учня.","success");
        else
            return GetFormatedMessage("Помилка","Не вдалося підтвердити користувача.","error"); 
    }

    public function getUserAccessLevel(Request $request){
        return $request->user()->access_level;
    }
    
    public function accessError(){
        return 0;
    }

    public function logout(Request $request){
        $request->user()->token()->revoke();
        return json_encode(["success" => true]);
    }

    public function getAllUserData(Request $request){
        return json_encode($request->user());
    }

    public function list($count = -1){
        return json_encode(User::list($count));
    }

    public function count($type){
        switch($type) {
            case "all":
                return User::userCount();
            case "confirmed":
                return User::specifiedUserCount("confirmed", 1);
            case "unconfirmed":
                return User::specifiedUserCount("confirmed", 0);
        }
    }

    public function getGroup(Request $request) {
        return response($request->user()->group);
    }

    public function change($id){
       $user = User::find($id);

        if($user->access_level == 1)
            $user->access_level = 2;
        else if($user->access_level == 2)
            $user->access_level = 1;

        if($user->save())
            return GetFormatedMessage("Готово","Рівень доступу користувача змінено.","success");
        else
            return GetFormatedMessage("Помилка","Не вдалося змінити рівень доступу користувача.","error"); 
    }

    public function changeEmail(Request $request, $id){
        $user = User::find($id);

        if($user == null)
            return GetFormatedMessage("Помилка","Користувача не знайдено.","error"); 
     
        $user->email = $request->input('email');
        
        if($user->save())
            return GetFormatedMessage("Готово","Ваша нова адреса пошти: ".$request->input('email').".","success");
        else
            return GetFormatedMessage("Помилка","Не вдалося змінити адресу пошти.","error"); 
    }

    public function changePassword(Request $request, $id){
        $user = User::find($id);

        if(!Hash::check($request->input('old_password'), $user->password))
            return GetFormatedMessage("Помилка","Старий пароль введено не вірно.","error"); 

        if($request->input('new_password') == $request->input('new_password_confirm')){
            $user->password = Hash::make($request->input('new_password'));

            if($user->save())
                return GetFormatedMessage("Готово","Ваш пароль змінено.","success"); 

        }else{
            return GetFormatedMessage("Помилка","Введені паролі не співпадають.","error"); 
        }
    }
}
