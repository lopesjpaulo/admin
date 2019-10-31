<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id');
            $table->date('published_at');
            $table->string('title');
            $table->string('file')->nullable();
            $table->text('resumo')->nullable();
            $table->integer('categoria_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
            $table->integer('year_id')->unsigned();
            $table->foreign('year_id')->references('id')->on('years')->onDelete('cascade');
            $table->integer('month_id')->unsigned();
            $table->foreign('month_id')->references('id')->on('months')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('files_tags', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('file_id')->unsigned();
           $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
           $table->integer('tag_id')->unsigned();
           $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
        Schema::dropIfExists('files_tags');
    }
}
