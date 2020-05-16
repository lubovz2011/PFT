<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable("users")){
            Schema::table("users", function (Blueprint $table){
                $table->string("name")->nullable()->change();
                $table->renameColumn("email","login");
                $table->enum("login_type", ["gmail", "facebook", "email"])->default("email");
                $table->enum("time_format", ["H:i", "h:i A"])->default("H:i");
                $table->enum("date_format", ["Y/m/d", "m/d/Y", "d/m/Y", "d.m.Y", "d-m-Y"])->default("d/m/Y");
                $table->enum("week_start", [0, 1, 2, 3, 4, 5, 6])->default(0);
                $table->enum("limit", [10, 20, 25, 50, 100])->default(25);
                $table->string("currency", 4)->default("USD");
                $table->string("currencies")->nullable();
                $table->boolean("monthly_report")->default(1);
                $table->renameColumn("email_verified_at", "status");
                $table->timestamp("last_activity")->default(\Illuminate\Support\Facades\DB::raw("CURRENT_TIMESTAMP"));
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
