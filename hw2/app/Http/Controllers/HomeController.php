<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use App\Models\Comments;
use App\Models\Likes_posts;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected function check_auth(){
        $session_id = session('user_id');
        $user = User::find($session_id);
        if (!isset($user))
            return view('login');
    }

    public function index() {
        $session_id = session('user_id');
        $user = User::find($session_id);
        if (!isset($user))
            return view('login');
        //check_auth();
        return view("home")->with("user", $user);
        //return view("home")->with("user", User::find($session_id));
    }

    public function feed_builder(){
        $session_id = session('user_id');
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
                              "post.no_comments as comments",
                              //"UNIX_TIMESTAMP(post.createdAt) AS UNIX_TIME"
                            )
                      ->orderBy('createdAt','desc')
                      ->limit(20)
                      ->get();
        
        
        $json = json_decode($res1);
        if (count($res1)>0){
            for($i=0;$i<count($res1);$i++){
                //$res[$i]->liked = "si";
                
                if(count(Likes_posts::where("cod_utente",$json[$i]->user)->where("cod_post",$json[$i]->name)->get())==0)
                    $json[$i]->liked = "no";
                else
                    $json[$i]->liked="si";
                
                $json[$i]->user = User::select("username")->where("id","=",$json[$i]->user)->first()["username"];
                
            }
            //return response()->json($res1);
            return response()->json(["result"=>"success","data"=>$json]);           
        }else{
            return response()->json(["result"=>"notFound","data"=>""]);
        }
    }

    public function fetch_comments($name){
        $res = Comments::select("cod_creatore as autore","testo","createdAt")
            ->where("cod_post",$name)
            ->orderBy('createdAt','asc')->get();
        $return = array("length" => count($res),"data"=>[]);
        if(count($res)==0){
            return response()->json($return);
        }
        $return["data"] = json_decode($res);
        for($i=0;$i<$return["length"];$i++){
            $return["data"][$i]->autore = User::select("username")->where("id","=",$return["data"][$i]->autore)->first()["username"];
        }
        
        return response()->json($return);
    }

    public function fetch_likes($post){
        $name = session("user_id");
        $res = Likes_posts::where("cod_utente",$name)->where("cod_post",$post)->get();
        if(count($res)==0){
            $return = array("operation" => "insert");
            Likes_posts::create(["cod_utente"=>$name,"cod_post"=>$post]);
        }else{
            Likes_posts::where("cod_utente",$name)->where("cod_post",$post)->delete();
            $return = array("operation" => "delete");
        }
        return response()->json($return);
    }

    public function feed_add($last){
        check_auth();
        $post = Post::orderBy('createdAt','desc')->where('createdAt','<',$last)->limit(5)->get();
        if (!empty($posts)){
            return response()->json($posts);         
        }
    }

    public function aggiorna_profilo(){
        $session_id = session('user_id');
        $user = User::where('id', $session_id)->get();
        if (!empty($user)){
            return response()->json($user);         
        }
    }

    public function new(){
        $json = Http::get('https://api.jikan.moe/v4/seasons/upcoming');
        return $json;
    }

    public function top_anime(){
        $json = Http::get('https://api.jikan.moe/v4/top/anime');
        return $json;
    }

    public function top_manga(){
        $json = Http::get('https://api.jikan.moe/v4/top/manga');
        return $json;
    }

    public function cerca_anime($id){
        $json = Http::get('https://api.jikan.moe/v4/anime/'.$id.'/full');
        return $json;
    }

    public function cerca_manga($id){
        $json = Http::get('https://api.jikan.moe/v4/manga/'.$id.'/full');
        return $json;
    }
}
