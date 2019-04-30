<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'province_id','name',
    ];

    protected $table = 'city';

    public function province(){
    	return $this->hasOne('App\Model\Province', 'id', 'province_id');
    }

    public static function getCity($city_id){
    	$city = City::select('*')->where('id',$city_id)->with('province')->first();
        return $city;
    }

    public static function getCityProvince($province_id){
    	return City::select('*')->where('province_id',$province_id)->with('province')->get();
    }
}
