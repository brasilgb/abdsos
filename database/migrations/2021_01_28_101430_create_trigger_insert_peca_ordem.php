<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTriggerInsertPecaOrdem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER `TRG_insert_peca_ordem` AFTER INSERT ON `ordem_peca`
        FOR EACH ROW
        BEGIN
        CALL SP_EstoquePeca (
            new.id_peca,
            new.quantidade * -1
                            );
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
        DB::unprepared('DROP TRIGGER `TRG_insert_peca_ordem`');
    }
}
