<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResearchGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_progetto')->nullable();
            $table->unsignedBigInteger('id_ricercatore')->nullable();
            $table->timestamps();
        });

        Schema::table('research_groups', function (Blueprint $table) {
            $table->foreign('id_progetto')->references('id')->on('projects');
            $table->foreign('id_ricercatore')->references('id')->on('users');
            $table->unique(['id_progetto','id_ricercatore']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('research_groups');
    }
}
