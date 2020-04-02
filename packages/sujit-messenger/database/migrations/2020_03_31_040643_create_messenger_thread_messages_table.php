<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessengerThreadMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(config('messenger.tables.messenger_thread_messages_table'))) {
            Schema::create(config('messenger.tables.messenger_thread_messages_table'), function (Blueprint $table) {
                $table->id();
                $table->bigInteger('messenger_thread_id');
                $table->longText('message')->nullable()->default(null);
                $table->string('status'); //received, pending, delivered
                $table->string('failed_reason')->nullable()->default(null);
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
        Schema::dropIfExists(config('messenger.tables.messenger_thread_messages_table'));
    }
}
