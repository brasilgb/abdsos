<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdemPecaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordem_peca', function (Blueprint $table) {
            $table->integer('id_ordem');
            $table->integer('id_peca');
            $table->integer('quantidade');
            $table->timestamps();

            $table->foreign('id_ordem')->references('id_ordem')->on('ordens')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_peca')->references('id_peca')->on('pecas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordem_peca');
    }
}
