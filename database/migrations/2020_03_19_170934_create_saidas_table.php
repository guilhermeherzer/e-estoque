<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saidas', function (Blueprint $table) {
            $table->id();
            $table->integer('produto');
            $table->integer('quantidade');
            $table->double('preco_unit');
            $table->double('preco_total');
            $table->dateTime('data_saida');
            $table->integer('tipo');
            $table->integer('status');
            $table->integer('criado_por');
            $table->integer('atualizado_por');
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
        Schema::dropIfExists('saidas');
    }
}
