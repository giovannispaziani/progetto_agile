<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRicercatoriSottoprogettiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ricercatori_sottoprogetti', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_sottoprogetto')->nullable();
            $table->unsignedBigInteger('id_ricercatore')->nullable();
            $table->timestamps();
        });

        Schema::table('ricercatori_sottoprogetti', function (Blueprint $table) {
            $table->foreign('id_sottoprogetto')->references('id')->on('subprojects')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_ricercatore')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unique(['id_sottoprogetto','id_ricercatore']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ricercatori_sottoprogetti');
    }
}
