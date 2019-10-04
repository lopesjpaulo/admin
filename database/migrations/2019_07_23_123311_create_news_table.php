<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->Increments('id');
            $table->timestamps();
            $table->dateTime('published_at');
            $table->string('title', 200);
            $table->mediumText('description');
            $table->longText('content');
            $table->string('author', 100)->nullable();
            $table->string('folder', 10)->nullable();
            $table->string('file', 100)->nullable();
            $table->tinyInteger('status')->default('0');
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
        Schema::dropIfExists('news');
    }
}
