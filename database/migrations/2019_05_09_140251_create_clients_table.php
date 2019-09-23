<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->Increments('id');
            $table->timestamps();
            $table->date('signed_at');
            $table->date('expired_at');
            $table->string('title', 100)->unique();
            $table->string('url', 255);
            $table->string('cnpj')->unique();
            $table->string('resp');
            $table->string('resp_cpf');
            $table->string('contact_phone');
            $table->string('contact_email');
            $table->string('type', 10);
            $table->integer('attendance_id')->unsigned();
            $table->foreign('attendance_id')->references('id')->on('attendances')->onDelete('cascade'); 
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
        Schema::dropIfExists('clients');
    }
}
