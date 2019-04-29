<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaAgendamentoFinanceiro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamento_financeiro', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome',100);
            $table->string('descricao');
            $table->double('valor',12,2);
            $table->boolean('tipo');
            $table->boolean('ativo')->default(1);
            $table->timestamp('data_inicio');
            $table->timestamps();

            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('tipo_dinheiro_id');
            $table->unsignedBigInteger('periodo_pagamento_id');
            
            $table->foreign('usuario_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tipo_dinheiro_id')->references('id')->on('tipo_dinheiro')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('periodo_pagamento_id')->references('id')->on('periodo_pagamento')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agendamento_financeiro');
    }
}
