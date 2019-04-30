<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Model\Admin;
use Redirect;
use Session;
use Auth;

class LoginController extends Controller
{
    //  use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    public function index(){
    	return view('admin.login');
    }

    public function postLogin(Request $request){
    	$user = Admin::getByUser($request->email);
        // dd(count($user));
        if(count($user)==1){
            if(Hash::check($request->password,$user->password)){
                $credentials = $request->only(['email', 'password']);
                $token = Auth::guard()->attempt($credentials);
                $request->session()->put('authenticated', true);
                $request->session()->put('session_user', $token);
                $request->session()->put('user', $user);
                return Redirect::route('dashboard');
            }else
                return Redirect::back()->withErrors("Wrong password");
        }else
            return Redirect::back()->withErrors("Wrong username");
    }

    public function register(request $request){
        $request->request->add(['password' => Hash::make($request->password)]);
        return Admin::create($request->all());
    }

    public function logout(Request $request){
        Auth::guard()->logout();
        $request->session()->forget('authenticated');
        $request->session()->forget('user');
        return redirect('login');
    }

}
