<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSottoprogettiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subprojects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_responsabile');
            $table->unsignedBigInteger('id_progetto')->constrained('projects')->onDelete('cascade');
            $table->string('titolo');
            $table->string('descrizione');
            $table->date('data_fine');
            $table->timestamps();
        });

        Schema::table('subprojects', function (Blueprint $table) {
            $table->foreign('id_responsabile')->references('id')->on('users')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subprojects');
    }
}
