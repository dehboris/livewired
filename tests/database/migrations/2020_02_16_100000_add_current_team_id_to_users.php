<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrentTeamIdToUsers extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('current_team_id')->nullable();

            $table->boolean('uses_two_factor_auth')->default(false);
            $table->string('two_factor_secret')->nullable();
            $table->string('two_factor_reset_code', 100)->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIfExists('current_team_id');

            $table->dropIfExists('uses_two_factor_auth');
            $table->dropIfExists('two_factor_secret');
            $table->dropIfExists('two_factor_reset_code');
        });
    }
}
