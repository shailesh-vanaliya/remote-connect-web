<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('organization_name')->nullable();
            $table->integer('user_count')->nullable();
            $table->integer('device_count')->nullable();
            $table->integer('max_device_limit')->nullable();
            $table->integer('max_user_limit')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('organizations');
    }
}
