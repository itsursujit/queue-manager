<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if(!Schema::hasTable(config('messenger.tables.vendor_services_table'))) {
            Schema::create(config('messenger.tables.vendor_services_table'), function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('service');
                $table->string('slug');
                $table->string('avatar')->nullable()->default(null);
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
        Schema::dropIfExists(config('messenger.tables.vendor_services_table'));
    }
}
