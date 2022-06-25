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
            $table->unsignedBigInteger('id_progetto');
            $table->unsignedBigInteger('id_ricercatore');
            $table->timestamps();
        });

        Schema::table('research_groups', function (Blueprint $table) {
            $table->foreign('id_progetto')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_ricercatore')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
