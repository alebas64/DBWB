<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('login');
});

Route::get('login', [LoginController::class, 'login'])->name("login");
Route::get('logout', [LoginController::class, 'logout'])->name("logout");
Route::post('login', [LoginController::class, 'checkLogin']);

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'create']);
Route::get('register/email/{query}', [RegisterController::class, 'checkEmail']);
Route::get("register/username/{q}", [RegisterController::class, 'checkUsername']);

Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('home/feed_fetch', [HomeController::class, 'feed_builder']);
Route::get('home/likes/{post}',[HomeController::class,'fetch_likes'])->name("fetch_likes");
Route::get('home/comments/{name}',[HomeController::class,'fetch_comments'])->name("fetch_comments");

Route::post('creaPost',[AnimeController::class, 'creaPost'])->name('creaPost');
Route::get('cercaAnime',[AnimeController::class, 'searchPage'])->name('cercaAnime');
Route::get('cercaAnime/ByName/{nome}/{nsfw?}/{page?}',[AnimeController::class, 'search_name']);
Route::get('cercaAnime/ByGenere/{nome}/{genere}/{nsfw?}/{page?}',[AnimeController::class, 'search_genere']);
Route::get('cercaAnime/GetGeneri',[AnimeController::class,'get_generi'])->name("generi");
Route::get('foxes',[AnimeController::class,'foxes'])->name('foxes');

Route::get('profile',[ProfileController::class,'index'])->name('profile'); //restituisce il proprio feed

Route::get('profile/feed/{user?}',[ProfileController::class,'feed_builder']); //restituisce i post di un utente
Route::post('profile/sendComment',[ProfileController::class,'create_comment'])->name("create_comment");
Route::get('profile/sendComment/{codPost}/{testo}',[ProfileController::class,'create_comment'])->name("create_comment");
Route::get('profile/search_page',[ProfileController::class,'search_page'])->name("search_page");
Route::get('profile/search/{name?}',[ProfileController::class,'userSearch']); //restituisce tutti i profili che hanno un nome simile
Route::get('profile/{user}',[ProfileController::class,'other_index'])->name('other_profile'); //restituisce il feed di una persona
Route::get('profile/getUser/{name}',[ProfileController::class,'userGet']);
Route::post('profile/change',[ProfileController::class,'changeValues'])->name('changeValues');
