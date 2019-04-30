<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Model\User;

class UserController extends Controller
{

	public function index(){
		dd(User::get());
	}
	protected function validator(array $data)
    {
        return Validator::make($data, [
        	'username' => 'required',
            'email' => 'required',
            'no_handphone' => 'required',
            'password' => 'required|string|min:6',
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
        ]);
    }

    public function register(Request $request){
    	$telp = User::getByTelp($request->no_handphone);
    	$email = User::getByEmail($request->email);
    	$username = User::getByUsername($request->username);

    	// dd(count($username));

		if($this->validator($request->all())->fails()){
    		return $this->failed('Need required parameter');
    	}else{
    		if(count($username)<1){
	    		if(count($email)<1){
	    			if(count($telp)<1){

	    				$request->request->add(['password' => Hash::make($request->password)]);
	    				$request->request->add(['aktif' => 1]);

	    				if(count($request->file_image)>0){
	    					$file = $request->file('file_image');
				            $photoName = $username.time() . '-' . $file->getClientOriginalName();
				            $file->move(public_path('/assets/profile'), $photoName);	
				            $request->request->add(['image' => '/assets/profile/'.$photoName]);	
	    				}else{
	    					$request->request->add(['image' => '/assets/profile/default.jpg']);	
	    				}

	    				// dd($request->image);
	    				
	    				$create = User::create($request->all());
    					
						return response()->json([
						"result" => true,
						"message" => "user successfully registered",
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

    public function login(Request $request){
    	
    	$username = User::getByUsername($request->username);
  		if(count($username)==0){
  			$username = User::getByEmail($request->username);
  			if(count($username)==0){
  				$username = User::getByTelp($request->username);
  			}
  		}
    	if(count($username)>0){
	    	if(Hash::check($request->password,$username->password)){
	            return response()->json([
		        	"result" => true,
		        	"message" => "Success Login",
		        	"data" => $username
		        	]);   
	    	}else{
	    		return $this->failed("Wrong password");	
	    	}
    	}else{
    		return $this->failed("Account is not found");
    	}

		
    }

    function failed($message){
    	return response()->json([
    			"result" => false,
    			"message" => $message
    			]);
    }
}
