<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaRegistroFinanceiro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_financeiro', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->string('descricao');
            $table->double('valor',12,2);
            $table->boolean('tipo');
            $table->boolean('doacao')->default(0);
            $table->boolean('ativo');
            $table->timestamp('data_pagamento');
            $table->timestamps();

            $table->unsignedBigInteger('responsavel_id');
            $table->unsignedBigInteger('sub_categoria_id');
            $table->unsignedBigInteger('tipo_dinheiro_id');
            $table->unsignedBigInteger('agendamento_financeiro_id');
            
            $table->foreign('responsavel_id')->references('id')->on('responsavel')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('sub_categoria_id')->references('id')->on('sub_categoria')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tipo_dinheiro_id')->references('id')->on('tipo_dinheiro')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('agendamento_financeiro_id')->references('id')->on('agendamento_financeiro')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_financeiro');
    }
}
