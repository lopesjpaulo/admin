<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVitrinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vitrines', function (Blueprint $table) {
            $table->Increments('id');
            $table->dateTime('published_at');
            $table->string('title', 200);
            $table->string('link', 255)->nullable();
            $table->mediumText('description')->nullable();
            $table->string('file', 200)->nullable();
            $table->tinyInteger('status')->default('0');
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
        Schema::dropIfExists('vitrines');
    }
}
