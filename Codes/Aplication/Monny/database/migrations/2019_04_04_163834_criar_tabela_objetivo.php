<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaObjetivo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objetivo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->double('valor',12,2);
            $table->integer('tipo');
            $table->boolean('ativo');
            $table->timestamps();

            $table->unsignedBigInteger('carteira_id');
            $table->unsignedBigInteger('tipo_dinheiro_id');

            $table->foreign('carteira_id')->references('id')->on('carteira')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tipo_dinheiro_id')->references('id')->on('tipo_dinheiro')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('objetivo');
    }
}
