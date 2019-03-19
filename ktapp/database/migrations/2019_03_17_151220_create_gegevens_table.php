<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGegevensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gegevens', function (Blueprint $table) {
            $table->increments('gegevens_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('gegevens_datum');
            $table->integer('gegevens_week');
            $table->integer('days_id')->unsigned();
            $table->foreign('days_id')->references('id')->on('days_of_week');
            $table->integer('gegevens_jaar');
            $table->text('gegevens_km')->nullable();
            $table->text('gegevens_locatie')->nullable();
            $table->text('gegevens_aankomst')->nullable();
            $table->text('gegevens_vertrek')->nullable();
            $table->text('gegevens_no')->nullable();
            $table->boolean('archived')->default(0);
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
        Schema::dropIfExists('gegevens');
    }
}
