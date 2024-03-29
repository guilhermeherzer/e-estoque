<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarcasProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marcas_produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', '50');
            $table->string('img', '150');
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
        Schema::dropIfExists('marcas_produtos');
    }
}
