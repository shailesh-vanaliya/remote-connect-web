<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeviceMapId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('device_map', function (Blueprint $table) {
            $table->unsignedInteger('organization_id')->after('id')->nullable();
            $table->unsignedInteger('device_type_id')->after('id')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('device_type_id')->references('id')->on('device_type')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('device_map', function (Blueprint $table) {
            //
        });
    }
}
