<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_progetto');
            $table->unsignedBigInteger('id_ricercatore')->nullable();
            $table->boolean('stato')->nullable()->default(null);
            $table->string('scopo');
            $table->decimal('budget');
            $table->timestamps();
        });

        Schema::table('budgets', function (Blueprint $table) {
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
        Schema::dropIfExists('budgets');
    }
}
