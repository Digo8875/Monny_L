<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaCartRegFin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_reg_fin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('ativo')->default(1);
            $table->timestamps();

            $table->unsignedBigInteger('carteira_id');
            $table->unsignedBigInteger('divida_id')->nullable()->default(NULL);
            $table->unsignedBigInteger('registro_financeiro_id');

            $table->foreign('carteira_id')->references('id')->on('carteira')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('divida_id')->references('id')->on('objetivo')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('registro_financeiro_id')->references('id')->on('registro_financeiro')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_reg_fin');
    }
}
