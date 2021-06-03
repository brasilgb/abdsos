<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->integer('id_cliente')->primary();
            $table->string('cliente', 50);
            $table->date('nascimento');
            $table->string('email', 50);
            $table->string('telefone', 50)->nullable();
            $table->string('celular', 50);
            $table->string('logradouro', 200);
            $table->integer('numero');
            $table->string('complemento', 50)->nullable();
            $table->string('bairro', 50);
            $table->char('estado', 100);
            $table->string('cidade', 50);
            $table->string('cep', 20);
            $table->string('cpf', 20)->nullable();
            $table->string('rg', 20)->nullable();
            $table->string('contato', 50)->nullable();
            $table->string('telefone_contato', 50)->nullable();
            $table->string('celular_contato', 50)->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
