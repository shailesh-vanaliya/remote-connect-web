<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('report_schedules', function (Blueprint $table) {
            $table->unsignedInteger('report_config_id')->nullable()->after('id');
            $table->foreign('report_config_id')->references('id')->on('report_configurations')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('reports', function (Blueprint $table) {
            $table->unsignedInteger('report_config_id')->nullable()->after('id');
            $table->foreign('report_config_id')->references('id')->on('report_configurations')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('report_configurations', function (Blueprint $table) {
            //
        });
    }
}
