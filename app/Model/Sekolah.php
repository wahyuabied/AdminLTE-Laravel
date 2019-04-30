<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $fillable = [
        'username','password','nama','tanggal_berdiri','email','no_handphone','alamat','province_id','city_id','website','accept','keterangan','image',
    ];

    protected $table = 'sekolahs';

    public function province(){
        return $this->hasOne('App\Model\Province', 'id', 'province_id');
    }

    public function city(){
        return $this->hasOne('App\Model\City', 'id', 'city_id');
    }


    public static function getSekolahFromProvinceCity($city_id){
        return Sekolah::select('*')->where('city_id',$city_id)->with(['province'])->with('city')->paginate(5);
    }

    public static function getByEmail($email){
        return Sekolah::select('*')->where('email',$email)->first();
    }

    public static function getByUsername($username){
        return Sekolah::select('*')->where('username',$username)->first();
    }

    public static function getByTelp($no_handphone){
        return Sekolah::select('*')->where('no_handphone',$no_handphone)->first();
    }
    protected $hidden = [
        'password','remember_token'
    ];
}
