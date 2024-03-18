<?php

namespace App\Http\Controllers;
//use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Post;
use App\Models\Comments;
use App\Models\Likes_posts;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function feed_builder($session_id = -1){
        if($session_id === -1) 
            $session_id = session('user_id');
        else
            $session_id = $this -> find_id($session_id);
        $user = User::find($session_id);
        if (!isset($user))
            return view('login');
        $res1 = Post::select("post.anime_title as title",
                              "post.cod_creatore as user" ,
                              "post.id as name",
                              "post.image_link as image",
                              "post.descr as descrizione",
                              "post.createdAt as createdOn",
                              "post.no_likes as likes",
                              "post.no_comments as comments"
                            )
                      ->where("cod_creatore",$session_id)
                      ->orderBy('createdAt','desc')
                      //->limit(20)
                      ->get();
        
        $json = json_decode($res1);
        if (count($res1)>0){
            for($i=0;$i<count($res1);$i++){
                if(count(Likes_posts::where("cod_utente",$json[$i]->user)->where("cod_post",$json[$i]->name)->get())==0)
                    $json[$i]->liked = "no";
                else
                    $json[$i]->liked="si";
                $json[$i]->user = User::select("username")->where("id","=",$json[$i]->user)->first()["username"];
            }
            //return response()->json($json);
            return response()->json(["result"=>"success","data"=>$json]);           
        }else{
            return response()->json(["result"=>"notFound","data"=>""]);
        }
    }

    public function userSearch($name="@"){
        $session_id = session('user_id');
        $user = User::find($session_id);
        if (!isset($user))
            return view('login');

        $res = User::select("username","nascita","sesso")
            ->where("id","!=",$session_id)
            ->where("username",'LIKE','%'.$name.'%')
            ->get();
        
        if(count($res)>0){
            $return = ["result"=>"success","data"=>$res];
        }  
        else{
            $return = ["result"=>"notFound","data"=>""];
        }   
        return response()->json($return);
    }

    public function search_page(){
        $session_id = session('user_id');
        $user = User::find($session_id);
        if (!isset($user))
            return view('login');
        
        return view("cerca_utente")->with("user", $user);
    }

    public function userGet($name){
        $session_id = session('user_id');
        $user = User::find($session_id);
        if (!isset($user))
            return view('login');

        $res = User::select("username","nascita","sesso")
            ->where("id","!=",$session_id)
            ->where("username",'=',$name)
            ->get();
        
        if(count($res)>0){
            $return = ["result"=>"success","data"=>$res];
        }  
        else{
            $return = ["result"=>"notFound","data"=>""];
        }   
        return response()->json($return);
    }

    private function find_id($name){
        return User::select("id")->where("username","=",$name)->first()["id"];
    }

    public function index() {
        $session_id = session('user_id');
        $user = User::find($session_id);
        if (!isset($user))
            return view('login');
        return view("profile")->with("user", $user);
    }

    public function other_index($utente) {
        $session_id = session('user_id');
        $user = User::find($session_id);
        if (!isset($user))
            return view('login');
        $utente = User::where("username",$utente)->first();
        return view("userFound")->with("user", $user)->with("utente",$utente);
    }


    public function create_comment($id, $testo){
        $session_id = session('user_id');
        $user = User::find($session_id);
        if (!isset($user))
            return view('login');
        $newComment = Comments::create([
            'cod_creatore' => $session_id,
            'cod_post' => $id,
            'testo' => $testo
        ]);

        if($newComment){
            $json = Comments::select("cod_creatore as autore","testo","createdAt")
                ->where("cod_post",$id)
                ->where("cod_creatore",$session_id)
                ->orderBy('createdAt','desc')->first();
            //$json = json_decode($json);
            $json["autore"]=User::select("username")
                ->where("id",$session_id)->first()["username"];
            //$json = json_encode($json);
            return response()->json($json);
        }

        return response()->json(['status'=>'fail']);
    }


    public function changeValues(){
        $session_id = session('user_id');
        $user = User::find($session_id);
        if (!isset($user))
            return view('login');
        //$return = array(["result"=>"success","data"=>$res]);
        $status = array();
        $request = request();

        //modifica username
        if(strlen($request['username'])!=0){
            if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/', $request['username'])) {
                $status += ["username" => "Username non valido"];
            }else{
                if (User::where('username', $request['username'])->first() !== null) {
                    $status += ["username" => "Username già utilizzato"];
                }else{
                    $user->update(['username' => $request['username']]);
                    $status += ["username" => "success"];
                }
            }
        }
        

        //modifica password
        
        if(strlen($request["password"])!=0||strlen($request["passwordC"])!=0){
            if (strlen($request["password"]) < 8) {
                $status += ["password" => "Caratteri password insufficienti"];
            }else{
                if(strcmp($request["password"], $request["passwordC"]) != 0) {
                    $status += ["password" => "Le password non coincidono"];
                }else{
                    $user->update(['password' => password_hash($request['password'], PASSWORD_BCRYPT)]);
                    $status += ["password" => "success"];
                }
            }
        }
        //modifica email
        
        if(strlen($request["email"])!=0){
            if(!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
                $status += ["email" => "Email non valida"];
            } else {
                if (User::where('email', $request['email'])->first() !== null) {
                    $status += ["email" => "Email già utilizzata"];
                }else{
                    $status += ["email" => "success"];
                    $user->update(['email' => $request['email']]);
                }
            }
        }
        return $status;
    }
/*
    public function delete(){
        $session_id = session('user_id');
        $user = User::find($session_id);
        $user->delete();
        Session::flush();
        $ris = true;
        return response()->json($ris);
    }*/
        
}
