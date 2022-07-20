<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanziatoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('finanziatore', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_progetto');
            $table->unsignedBigInteger('id_finanziatore');
            $table->decimal('fondo');
            $table->timestamps();
        });

        Schema::table('finanziatore', function (Blueprint $table) {
            $table->foreign('id_progetto')->references('id')->on('projects')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_finanziatore')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finanziatore');
    }
}
