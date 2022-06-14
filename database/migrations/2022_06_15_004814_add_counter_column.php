<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCounterColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('notification_quota')->default(0)->after('email_alert')->nullable();
            $table->integer('notification_counter')->default(0)->after('email_alert')->nullable();
            $table->integer('email_quota')->default(0)->after('email_alert')->nullable();
            $table->integer('email_counter')->default(0)->after('email_alert')->nullable();
            $table->integer('sms_quota')->default(0)->after('email_alert')->nullable();
            $table->integer('sms_counter')->default(0)->after('email_alert')->nullable();
            $table->integer('report_quota')->default(0)->after('email_alert')->nullable();
            $table->integer('report_counter')->default(0)->after('email_alert')->nullable();
            $table->integer('storage_quota')->default(0)->after('email_alert')->nullable();
            $table->integer('storage_usage')->default(0)->after('email_alert')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
