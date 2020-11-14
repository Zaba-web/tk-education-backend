<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        $this->validate($request,[
            "login" => "required|min:3",
            "email" => "required|min:6",
            "password" => "required|min:6|confirmed",
            "name" => "required|min:4"
        ]);

        $user = new User();
        $user->login = $request->input('login');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->name = $request->input('name');
        $user->group_id = $request->input('group');

        if($user->save()){
            return redirect('register/done');
        }
    }

    public function registerDone(){
        return $this->showMessage("Вітаємо з реєстрацією", "Ваш профіль зареєстровано та надіслано на модерацію.<br> Ви зможете увійти в систему після підтвердження майстром в/н.");
    }

    public function login(Request $request){
        $login = $request->input('login');
        $password = $request->input('password');
        $user = User::where('login', $login)->first();

        if($user === null){
            return $this->showMessage();
        }

        if($user->confirmed == 0){
            return $this->showMessage("Помилка підтвердження", "Ваш профіль не підтверджено. Зверніться до вашого майстра в/н. для отримання додаткової інформації.");
        }

        if(Auth::attempt($request->only(['login', 'password']))){
            if($user->access_level == 2){
                return redirect("admin/home");
            }
            if($user->access_level == 1){
                return redirect("dashboard/home");
            }
        }else{
            return $this->showMessage();
        }

    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    private function showMessage($title = 'Не вдалося увійти', $text = 'Системі не вдалося знайти ваш профіль. Перевірте правильність введених даних та спробуйте ще раз.'){
        $msg = [
            "title" => $title,
            "text" => $text,
            "url" => "/"
        ];
        return view('home_massage')->with('message', $msg);
    }

}
