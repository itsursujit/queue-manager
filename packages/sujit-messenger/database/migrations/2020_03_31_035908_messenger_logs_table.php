<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MessengerLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(config('messenger.tables.messenger_logs_table'))) {
            Schema::create(config('messenger.tables.messenger_logs_table'), function (Blueprint $table) {
                $table->id();
                $table->bigInteger('user_id');
                $table->bigInteger('vendor_service_id');
                $table->longText('request_data')->nullable()->default(null);
                $table->string('request_url')->nullable()->default(null);
                $table->string('request_type')->nullable()->default(null); // SENT, RECEIVE, CALLBACK
                $table->text('response')->nullable()->default(null);
                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists(config('messenger.tables.messenger_logs_table'));
    }
}
