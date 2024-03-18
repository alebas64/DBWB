<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login() {
        if(session('user_id') != null) {
            return redirect("home");
        }
        else {
            return view('login')
            ->with('csrf_token', csrf_token());
        }
     }

    public function checkLogin() {
        $request = request();
        $res = $this->countErrors($request);
        if(count($res)===0){
            return redirect('home');
        }else{
            return redirect('login')
            ->withErrors($res)
            ->withInput();
        }
    }

    private function countErrors($data){
        $error = array();
        $user = User::where('username', request('username'))->first();
        if($user !== null) {
            if(Hash::check(request('password'), $user->password, )){
                Session::put('user_id', $user->id);
            }else{
                $error += ["credentials" => "Credenziali errate"];
            }
        }else{
            $error += ["credentials" => "Credenziali errate"];
        }
        return $error;
    }

    public function logout() {
        Session::flush();
        return redirect('login');
    }
}
