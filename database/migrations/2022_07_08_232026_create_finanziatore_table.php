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
