<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedUserProfileFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('titolo_pubScientifica')->after('email');
            $table->text('fonte_pubScientifica')->after('titolo_pubScientifica');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {php artisan migrate
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('titolo_pubScientifica');
            $table->dropColumn('fonte_pubScientifica');
        });
    }
}
