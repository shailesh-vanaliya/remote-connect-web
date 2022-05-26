<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReportConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('report_id')->nullable();
            $table->integer('device_id')->nullable();
            $table->string('organization_id')->nullable();
            $table->string('report_title')->nullable();
            $table->string('parameter')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('report_configurations');
    }
}
