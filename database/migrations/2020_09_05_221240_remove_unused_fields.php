<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveUnusedFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable("users")) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn(['time_format', 'week_start', 'last_activity', 'identifier']);
            });
        }

        if(Schema::hasTable("accounts")) {
            Schema::table('accounts', function (Blueprint $table) {
                $table->dropColumn(['created_at', 'updated_at']);
            });
        }

        if(Schema::hasTable("categories")) {
            Schema::table('categories', function (Blueprint $table) {
                $table->dropColumn(['created_at', 'updated_at']);
            });
        }

        if(Schema::hasTable("transactions")) {
            Schema::table('transactions', function (Blueprint $table) {
                $table->dropColumn(['created_at', 'updated_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
