<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Sekolah;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SekolahController extends Controller
{
    public function index(){
    	return view('admin.sekolah');
    }


    public function register(Request $request){
    	$telp = Sekolah::getByTelp($request->no_handphone);
    	$email = Sekolah::getByEmail($request->email);
    	$username = Sekolah::getByUsername($request->username);

    	if(!empty($username)||$username==null){
                if(!empty($email)||$email==null){
                    if(!empty($telp)||$telp==null){
                    $request->request->add(['password' => Hash::make($request->password)]);
    				$create = Sekolah::create($request->all());
    				
                    return redirect()->back()->with('error', 'User is registered');		
    				
    			}else{
    				return redirect()->back()->with('error', 'Duplicated No. Handphone');		
    			}
    		}else{
    			return redirect()->back()->with('error', 'Duplicated Email');	
    		}
    	}else{
    		return redirect()->back()->with('error', 'Duplicated Username');
    	}

    }
}
