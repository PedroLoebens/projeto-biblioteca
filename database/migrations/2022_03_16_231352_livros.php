<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('livros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('codigoGenero');
            $table->integer('codigoLivro');
            $table->string('titulo', 250);
            $table->string('descricao', 250);
        });
    }

    public function down()
    {
        //
    }
};
