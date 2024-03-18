<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateTrigger extends Migration {

    public function up()
    {
        DB::unprepared("
        CREATE TRIGGER anime_trigger
        AFTER INSERT ON lista_anime
        FOR EACH ROW
        BEGIN
        UPDATE users
        SET n_anime = n_anime + 1
        WHERE id = new.id;
        END
        ");
        
        DB::unprepared("
        CREATE TRIGGER delete_anime_trigger
        AFTER DELETE ON lista_anime
        FOR EACH ROW
        BEGIN
        UPDATE users
        SET n_anime = n_anime - 1
        WHERE id = old.id;
        END 
        ");


    }

    public function down()
    {
        DB::raw("
        DROP TRIGGER 'anime_trigger';
        DROP TRIGGER 'delete_anime_trigger';
        ");
    }
}
