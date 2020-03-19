<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiposSaidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_saidas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->string('descricao', 255);
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
        Schema::dropIfExists('tipos_saidas');
    }
}
