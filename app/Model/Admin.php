<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'email','password','nama','image',
    ];

    protected $table = 'admins';

    protected $hidden = [
        'password','remember_token'
    ];

    public static function getByUser($email){
        return Admin::select('*')->where('email',$email)->first();
    }

}
