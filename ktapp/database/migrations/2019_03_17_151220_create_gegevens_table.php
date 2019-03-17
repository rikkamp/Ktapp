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
            $table->increments('GegevensId');
            $table->text('UserId');
            $table->date('GegevensDatum');
            $table->integer('GegevensWeek');
            $table->enum('GegevensDag', ['Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag', 'Zondag']);
            $table->integer('GegevensJaar');
            $table->text('GegevensKm')->nullable();
            $table->text('GegevensLocatie')->nullable();
            $table->text('GegevensAankomst')->nullable();
            $table->text('GegevensVertrek')->nullable();
            $table->text('GegevensNo')->nullable();
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
