<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarefasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tarefas', function (Blueprint $table) {
            $table->integer('id_tarefa')->primary();
            $table->date('data_inicio');
            $table->time('hora_inicio');
            $table->date('data_previsao');
            $table->time('hora_previsao');
            $table->string('descritivo');
            $table->text('descricao');
            $table->date('data_termino')->nullable();
            $table->time('hora_termino')->nullable();
            $table->integer('status');
            $table->integer('tecnico')->nullable();
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('tarefas');
    }

}
