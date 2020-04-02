<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessengerThreadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(config('messenger.tables.messenger_threads_table'))) {
            Schema::create(config('messenger.tables.messenger_threads_table'), function (Blueprint $table) {
                $table->id();
                $table->string('label');
                $table->bigInteger('user_id');
                $table->bigInteger('user_service_id');
                $table->string('recipient');
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
        Schema::dropIfExists(config('messenger.tables.messenger_threads_table'));
    }
}
