<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Auth\LoginController;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLoginForm(){
        return view('admin.auth.login');
    }

    public function login(Request $req){
        if($req->isMethod('POST')){
            $data = $req->input();
            $this->validate($req,[
                'username' => 'required|min:5',
                'password' => 'required|min:6'
            ]);
            
            if(Auth::attempt(['username' => $req->username, 'password' => $req->password], $req->remember)){
                session::put('adminSession',$data['username']);
                return redirect()->intended(route('admin.dashboard'));
            }
                $errors = new MessageBag(['username' => ['username hoặc mật khẩu không chính xác!']]);
                return Redirect::back()->withErrors($errors)->withInput($req->only('username','remember'));
            
        }

    }

    public function logout(Request $req){
        Auth::guard('admin')->logout();
        $req->session()->flush();

        $req->session()->regenerate();
    
        return redirect()->guest(route( 'admin' ));
    }
}
