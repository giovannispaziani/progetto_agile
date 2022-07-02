<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScientificPublicationsTable extends Migration
{
    /*
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scientific_publications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ricercatore');
            $table->string('titolo');
            $table->string('descrizione')->nullable(true);
            $table->string('testo')->nullable(true);
            $table->string('fonte');
            $table->timestamps();
        });

        Schema::table('scientific_publications', function (Blueprint $table) {
            $table->foreign('id_ricercatore')->references('id')->on('users');
        });

    }

    /*
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scientific_publication');
    }
}
