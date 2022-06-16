<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChartColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('device_type', function (Blueprint $table) {
            $table->longText('chart_alias')->after('parameter_alias')->nullable();
        });
        Schema::table('device_aliasmap', function (Blueprint $table) {
            $table->longText('chart_alias')->after('parameter_alias')->nullable();
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
