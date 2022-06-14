<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHoneywellPidAliasmapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('honeywell_pid_aliasmap', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->unsignedInteger('device_id')->nullable();
        //     $table->longText('alias_map')->nullable();
        //     $table->unsignedInteger('updated_by')->nullable();
        //     $table->unsignedInteger('created_by')->nullable();
        //     $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        //     $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        //     $table->timestamps();
        //     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('honeywell_pid_aliasmap');
    }
}
