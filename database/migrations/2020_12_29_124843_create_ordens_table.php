<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOrdensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordens', function (Blueprint $table) {
            $table->integer('id_ordem')->primary();
            $table->integer('cliente_id');
            $table->foreign('cliente_id')->references('id_cliente')->on('clientes')->onDelete('cascade');
            $table->string('equipamento');
            $table->string('modelo');
            $table->string('senha');
            $table->text('defeito');
            $table->text('estado');
            $table->text('acessorios')->nullable();
            $table->text('observacoes')->nullable();
            $table->date('previsao')->nullable();
            $table->text('orcamento')->nullable();
            $table->decimal('valorcamento')->nullable();
            $table->text('servico')->nullable();
            $table->decimal('valservico')->nullable();
            $table->decimal('valtotal')->nullable();
            $table->integer('status')->nullable();
            $table->integer('pagamento')->nullable();
            $table->date('dt_entrega')->nullable();
            $table->integer('tecnico')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordens');
    }
}
