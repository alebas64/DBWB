<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected function create(){
        $request = request();
        $res = $this->countErrors($request);
        if(count($res) === 0) {
            $password = password_hash($request['password'], PASSWORD_BCRYPT);


            $newUser =  User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => $password,
            'sesso' => $request['sesso'],
            'nascita' => $request['nascita'],
            ]);
            if ($newUser) {
                Session::put('user_id', $newUser->id);
                return redirect('home');
            } 
            else {
                return redirect('register')->withErrors($res)->withInput();
            }
        }
        else {
            return redirect('register')->withErrors($res)->withInput();
        }
    }
    private function countErrors($data) {
        $error = array();
        $len = 0;
        # USERNAME
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $data['username'])) {
            $error += ["usernameCh" => "Username non valido"];
           // $len = $len+1;
        } else {
            $username = User::where('username', $data['username'])->first();
            if ($username !== null) {
                $error += ["usernameUsed" => "Username già utilizzato"];
            }
        }
        # PASSWORD
        if (strlen($data["password"]) < 8) {
            $error += ["pswLen" => "Caratteri password insufficienti"];
        } 
        # CONFERMA PASSWORD
        if (strcmp($data["password"], $data["passwordC"]) != 0) {
            $error += ["pswMs" => "Le password non coincidono"];
        }
        # EMAIL
        if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $error += ["emailCh" => "Email non valida"];
        } else {
            $email = User::where('email', $data['email'])->first();
            if ($email !== null) {
                $error += ["emailUsed" => "Email già utilizzata"];
            }
        }

        /*
        if(!$data["nascita"]){
            $error[]="Data di nascita non valida";
        }else{
            //if($time - $date < )
        }
        */
       
        return $error;
    }

    public function checkUsername($query) {
        $exist = User::where('username', $query)->exists();
        return ['exists' => $exist];
    }

    public function checkEmail($query) {
        $exist = User::where('email', $query)->exists();
        return ['exists' => $exist];
    }

    public function index() {
        return view('register');
    } 

}
