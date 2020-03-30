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
        if(!Schema::hasTable('vendor_services')) {
            Schema::create('vendor_services', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger('vendor_id');
                $table->bigInteger('service_id');
                $table->string('auth_url');
                $table->string('message_sending_url');
                $table->string('message_receiving_url');
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
                $table->timestamps();
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
        Schema::dropIfExists('vendor_services');
    }
}
