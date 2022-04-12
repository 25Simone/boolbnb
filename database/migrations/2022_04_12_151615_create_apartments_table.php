<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
           
            // title
            $table->string('title', 100);
            // rooms number
            $table->tinyInteger('rooms_number')->default(1);
            // beds number
            $table->tinyInteger('beds_number')->default(1);
            // baths number
            $table->tinyInteger('baths_number');
            // guests
            $table->tinyInteger('guests')->default(1);
            // squaremeters
            $table->smallInteger('squaremeters')->nullable();
            // longitude
            $table->string('longitude');
            // latitude
            $table->string('latitude');
            // visible
            $table->boolean('visible')->default(1);
            // slug
            $table->string('slug')->unique();
            // photo
            $table->string('photo');
            // address
            $table->text('address');
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
        Schema::dropIfExists('apartments');
    }
}
