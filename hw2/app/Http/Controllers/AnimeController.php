<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    public function searchPage(){
        $session_id = session('user_id');
        $user = User::find($session_id);
        if (!isset($user))
            return view('login');
        
        return view("create_post")->with("user", $user);
    }

    public function search_name($nome, $sfw = "true", $page = "1"){
        $json = Http::get('https://api.jikan.moe/v4/anime?q='.$nome.'&page='.$page.'&sfw='.$sfw);
        return $json;
    }

    public function search_genere($nome,$genere, $sfw = "true", $page = "1"){
        $json = Http::get('https://api.jikan.moe/v4/anime?q='.$nome.'&genres='.$genere."&page=".$page.'&sfw='.$sfw);
        return $json;
    }

    public function get_generi(){
        $json = Http::get("https://api.jikan.moe/v4/genres/anime");
        return $json;
    }

    public function foxes(){
        $json = Http::get('https://randomfox.ca/floof/');
        return $json;
    }

    protected function creaPost(){
        $request = request();
        $newPost = Post::create([
            'cod_creatore' => session('user_id'),
            'image_link' => $request['pic'],
            'anime_id' => $request['id'],
            'anime_title' => $request['title'],
            'descr'=>$request['recensione']
        ]);
        return redirect('home');
    }
}
