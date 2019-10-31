<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('organizacao_id')->unsigned();
            $table->foreign('organizacao_id')->references('id')->on('organizacaos')->onDelete('cascade');
            $table->integer('catorganizacao_id')->unsigned();
            $table->foreign('catorganizacao_id')->references('id')->on('catorganizacaos')->onDelete('cascade');
            $table->string('gestor');
            $table->string('processo');
            $table->date('data_inicio');
            $table->date('data_final');
            $table->string('abrangencia');
            $table->integer('status');
            $table->text('conteudo');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
