<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePubblicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pubblications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_autore');
            $table->unsignedBigInteger('id_progetto')->nullable('true');
            $table->string('titolo');
            $table->string('file_path');
            $table->date('date');
            $table->timestamps();
        });

        Schema::table('pubblications', function (Blueprint $table) {
            $table->foreign('id_progetto')->references('id')->on('projects')->onUpdate('cascade')->onDelete('set null');
            $table->foreign('id_autore')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pubblications');
    }
}
