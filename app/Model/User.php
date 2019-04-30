<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','email','password','no_handphone','password','nama','alamat','tempat_lahir','tanggal_lahir','image','aktif','remember_token',
    ];

    protected $table = 'users';

    public static function getByTelp($telp){
        return User::select('*')->where('no_handphone',$telp)->first();
    }

    public static function getByEmail($email){
        return User::select('*')->where('email',$email)->first();
    }

    public static function getByUsername($username){
        return User::select('*')->where('username',$username)->first();
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
