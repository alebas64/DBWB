<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Lista_anime;
use Illuminate\Http\Request;

class ListaController extends Controller
{
    public function index() {
        $session_id = session('user_id');
        $user = User::find($session_id);
        if (!isset($user))
            return view('welcome');

        return view("lista_anime")->with("user", $user);
    }

    public function aggiorna_lista(){
        $session_id = session('user_id');
        $user = Lista_anime::where('user', $session_id)->get();
        $cont = count($user);
        if($cont !=0){
        return response()->json($user); 
        }else {
            $user = "Nessun anime";
            return response()->json($user); 
        }  

    }

    public function delete($id){
        $session_id = session('user_id');
        $user = Lista_anime::where('user', $session_id)->where('anilist_id', $id)->delete();
        if($user != null){
            $ris = true;
            return response()->json($ris); 
        }else {
            $ris = false;
            return response()->json($ris); 
        }  

    }
}
