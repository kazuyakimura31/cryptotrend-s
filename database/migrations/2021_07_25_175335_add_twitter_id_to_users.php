<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTwitterIdToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('twitter_id')->nullable();
            $table->string('nickname')->nullable();
            $table->string('avatar')->nullable();
            $table->string('token')->nullable();
            $table->string('tokensecret')->nullable();
            $table->string('autofollow')->nullable();
            $table->date('follow_day')->nullable();
            $table->string('follow_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('twitter_id');
            $table->dropColumn('nickname');
            $table->dropColumn('avatar');
            $table->dropColumn('token');
            $table->dropColumn('tokensecret');
            $table->dropColumn('autofollow');
            $table->dropColumn('follow_day');
            $table->dropColumn('follow_count');
        });
    }
}
