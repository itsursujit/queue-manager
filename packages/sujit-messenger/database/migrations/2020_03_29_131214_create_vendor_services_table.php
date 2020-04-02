<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable(config('messenger.tables.vendor_service_details_table'))) {
            Schema::create(config('messenger.tables.vendor_service_details_table'), function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('vendor_id');
                $table->bigInteger('service_id');
                $table->text('auth_extra_fields')->nullable()->default(null);
                $table->text('auth_headers')->nullable()->default(null);
                $table->text('message_sending_headers')->nullable()->default(null);
                $table->text('message_receiving_headers')->nullable()->default(null);
                $table->string('auth_url')->nullable()->default(null);
                $table->string('auth_type')->nullable()->default(null);
                $table->boolean('use_generated_token_for_auth')->nullable()->default(false);
                $table->string('message_sending_url')->nullable()->default(null);
                $table->string('message_receiving_url')->nullable()->default(null);
                $table->string('notify_url')->nullable()->default(null);
                $table->boolean('allow_sending')->nullable()->default(false);
                $table->boolean('allow_receiving')->nullable()->default(false);
                $table->boolean('allow_optout')->nullable()->default(false);
                $table->boolean('allow_emojis')->nullable()->default(false);
                $table->boolean('allow_multimedia')->nullable()->default(false);
                $table->boolean('has_client_credentials')->nullable()->default(false);
                $table->boolean('allow_custom_sender_id')->nullable()->default(false);
                $table->boolean('use_as_sender_id')->nullable()->default(false);
                $table->boolean('is_admin_managed')->nullable()->default(false);
                $table->boolean('is_auto')->nullable()->default(false);
                $table->integer('setup_period')->nullable()->default(0);
                $table->integer('min_subscription_period')->nullable()->default(0);
                $table->text('available_countries')->nullable()->default(null);
                $table->text('credentials')->nullable()->default(null);
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
        Schema::dropIfExists(config('messenger.tables.vendor_service_details_table'));
    }
}
