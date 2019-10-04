<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name', 255);
            $table->string('email', 255)->nullable();
            $table->string('phone', 14)->nullable();
            $table->string('subject', 100)->nullable();
            $table->mediumText('content')->nullable();
            $table->tinyInteger('lido')->default('0');
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
        Schema::dropIfExists('contacts');
    }
}
