<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model {
    public $timestamps = false;

    protected $table = 'comments';

    protected $fillable = [
        'cod_creatore',
        'cod_post',
        'createdAt',
        'testo'
    ];

/*
    public function user() {
        return $this->belongsToMany("App\Models\User");
    }
*/
}   
?>