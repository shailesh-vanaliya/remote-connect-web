<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJsonColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('device_type', function (Blueprint $table) {
            $table->longText('dashboard_alias')->after('dashboard_id')->nullable();
            $table->longText('parameter_alias')->after('dashboard_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('device_type', function (Blueprint $table) {
            //
        });
    }
}
