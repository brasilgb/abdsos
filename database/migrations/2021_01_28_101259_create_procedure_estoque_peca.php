<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProcedureEstoquePeca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        DROP PROCEDURE IF EXISTS `SP_EstoquePeca`;
        CREATE PROCEDURE `SP_EstoquePeca`(
            IN `SP_peca` INT(10),
            IN `SP_quantidade` INT(10))
            BEGIN declare contador int(10);
            select count(*) into contador from estoque_peca where id_peca = SP_peca;
            if contador > 0 then
            update estoque_peca set id_peca = SP_peca, quantidade = quantidade + SP_quantidade where id_peca = SP_peca;
            else
            insert into estoque_peca ( id_peca, quantidade ) values( SP_peca, SP_quantidade );
            end if;
            END
            ');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS `SP_EstoquePeca`');
    }
}
