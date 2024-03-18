<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    public $timestamps = false;
    
    protected $table = 'post';

    protected $fillable = [
        'cod_creatore',
        'image_link',
        'anime_id',
        'anime_title',
        'descr',
        'createdAt',
        'no_likes',
        'no_comments'
    ];

    protected $casts = [
        'content' => 'array'
    ];

    public function user() {
        return $this->belongsToMany("App\Models\User");
    }

}   
?>