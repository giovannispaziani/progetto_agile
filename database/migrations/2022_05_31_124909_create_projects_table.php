<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_responsabile');
            $table->string('nome');
            $table->string('descrizione');
            $table->date('data_inizio');
            $table->date('data_fine');
            $table->enum('stato',['in corso','concluso','cancellato']);
            $table->timestamps();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->foreign('id_responsabile')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
