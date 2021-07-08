<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function group(){
        return $this->belongsTo('App\Groups', 'group_id', 'id');
    }

    public function getAccessLevel(){
        return $this->access_level;
    }

    public function isOnline(){
        return Cache::has('user-'.$this->id);
    }

    public static function list($count = null){

        if($count == null)
            return User::all()->sortByDesc('id');
        else
            return User::all()->sortByDesc('id')->take($count);
    }

    public static function userCount(){
        $usersCount = User::count();
        return $usersCount;
    }

    public static function specifiedUserCount($field, $value){
        $usersCount = User::where($field, $value)->count();
        return $usersCount;
    }
    
}
