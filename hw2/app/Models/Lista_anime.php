<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lista_anime extends Model {

    protected $table = 'lista_anime';

    protected $fillable = [
        'anilist_id', 'nome', 'url_img', 'user'
    ];

    protected $casts = [
        'content' => 'array'
    ];

    public function user() {
        return $this->belongsToMany("App\Models\User");
    }

}   
?>