<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeviceMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('device_map', function (Blueprint $table) {
            $table->increments('id');
            $table->string('MQTT_ID');
            $table->string('MODEM_ID');
            $table->string('secret_key');
            $table->integer('max_user_acess');
            $table->bigInteger('IMEI_No');
            $table->bigInteger('SIM_No');
            $table->string('SIM_Plan');
            $table->string('subscription_expire_date')->nullable();
            $table->string('subscription_status')->nullable();
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('device_map');
    }
}
