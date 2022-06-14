<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_progetto');
            $table->unsignedBigInteger('id_finanziatore');
            $table->timestamps();
        });

        Schema::table('financial_groups', function (Blueprint $table) {
            $table->foreign('id_progetto')->references('id')->on('projects');
            $table->foreign('id_finanziatore')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financial_groups');
    }
}
