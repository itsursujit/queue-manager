<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUserServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(config('messenger.tables.user_services_table'))) {
            Schema::create(config('messenger.tables.user_services_table'), function (Blueprint $table) {
                $table->id();
                $table->bigInteger('user_id');
                $table->bigInteger('vendor_service_id');
                $table->text('credentials')->nullable()->default(null);
                $table->string('service_particular')->nullable()->default(null);
                $table->text('particular_details')->nullable()->default(null);
                $table->boolean('has_credentials')->nullable()->default(false);
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
        Schema::dropIfExists(config('messenger.tables.user_services_table'));
    }
}
