<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaAgendamentoParcelado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agendamento_parcelado', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('ativo');
            $table->integer('numero_parcelas');
            $table->timestamps();

            $table->unsignedBigInteger('agendamento_financeiro_id');

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
        Schema::dropIfExists('agendamento_parcelado');
    }
}
