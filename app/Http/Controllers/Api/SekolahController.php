<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Model\Sekolah;
use App\Model\Province;
use App\Model\City;

class SekolahController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
        	'username' => 'required',
            'nama' => 'required',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
            'tanggal_berdiri' => 'required',
            'no_handphone' => 'required',
            'alamat' => 'required',
            'city_id' => 'required',
            'province_id' => 'required'
        ]);
    }

    public function getAllCity(){
        return City::get();
    }

    public function getAllProvince(){
        return Province::get();
    }

    public function getDetailCity($id){
        return City::getCity($id);
    }

    public function getCityFromProvince($province_id){
        return City::getCityProvince($province_id);
    }

    public function getSekolahFromCityProvince($city_id){
        return Sekolah::getSekolahFromProvinceCity($city_id);
    }

    public function register(Request $request){
        // dd("sampai");
    	$telp = Sekolah::getByTelp($request->no_handphone);
    	$email = Sekolah::getByEmail($request->email);
    	$username = Sekolah::getByUsername($request->username);

    	// dd($username);
		if($this->validator($request->all())->fails()){
    		return $this->failed('Need required parameter');
    	}else{
    		if(count($username)<1){
                if(count($email)<1){
                    if(count($telp)<1){
                        if(count($request->file_image)>0){
                            $file = $request->file('file_image');
                            $photoName = $username.time() . '-' . $file->getClientOriginalName();
                            $file->move(public_path('/assets/sekolah'), $photoName);    
                            $request->request->add(['image' => '/assets/sekolah/'.$photoName]); 
                        }else{
                            $request->request->add(['image' => '/assets/sekolah/default.jpg']); 
                        }

                        $request->request->add(['password' => Hash::make($request->password)]);

	    				$create = Sekolah::create($request->all());
	    				$create->accept = 0;
	    				$create->save();
    					
						return response()->json([
						"result" => true,
						"message" => "Sekolah is Registered, please wait our confirm !!!",
						"data"=>$create,
						]);	
	    			
	    			}else{
	    				return $this->failed("Duplicated No. Handphone");
	    			}
	    		}else{
	    			return $this->failed("Duplicated Email");
	    		}
	    	}else{
	    		return $this->failed("Duplicated Username");
	    	}
	    }
    }

    public function deleteSekolah(Request $request){
        $data = Sekolah::find($request->id);
        if(count($data)<1){
            return $this->failed("Data is not found");
        }else{
            $data->delete();
            return response()->json([
                "result" => true,
                "message" => "Sekolah is deleted"
                ]);
        }
    }

    public function updateSekolah(Request $request){
        $data = Sekolah::find($request->id);
        if(count($data)<1){
            return $this->failed("Data is not found");
        }else{
            if($this->validator($request->all())->fails()){
                return $this->failed('Need required parameter');
                }else{
                    if(count($request->file_image)>0){
                        $file = $request->file('file_image');
                        $photoName = $username.time() . '-' . $file->getClientOriginalName();
                        $file->move(public_path('/assets/sekolah'), $photoName);    
                        $request->request->add(['image' => '/assets/sekolah/'.$photoName]); 
                    }else{
                        $request->request->add(['image' => '/assets/sekolah/default.jpg']); 
                    }
                    $data->update($request->all());
                    return response()->json([
                    "result" => true,
                    "message" => "success update data",
                    "data" => $datas
                    ]);
                }
        }   
    }

    public function getSekolah(Request $request){
        $data = Sekolah::get();
        $datas = Sekolah::paginate(5);
        if(count($data)>0){
            return response()->json([
                "result" => true,
                "message" => "success get data",
                "data" => $datas
                ]);
        }else{
            return $this->failed("There is no data");
        }
    }

    function failed($message){
    	return response()->json([
    			"result" => false,
    			"message" => $message
    			]);
    }


}
