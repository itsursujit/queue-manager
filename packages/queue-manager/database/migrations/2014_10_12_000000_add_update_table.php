<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddUpdateTable extends Migration {

    public function up()
    {
        Schema::dropIfExists('manager_jobs');
        Schema::create('manager_jobs', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->text('command');
            $table->tinyInteger('attempts')->unsigned();
            $table->dateTime('created');
            $table->dateTime('updated');
            $table->dateTime('completed')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('manager_jobs');
    }
}
