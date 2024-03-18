<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Likes_posts extends Model {
    public $timestamps = false;

    protected $table = 'likes_posts';

    protected $fillable = [
        'cod_utente',
        'cod_post'
    ];

/*
    public function user() {
        return $this->belongsToMany("App\Models\User");
    }
*/
}   
?>