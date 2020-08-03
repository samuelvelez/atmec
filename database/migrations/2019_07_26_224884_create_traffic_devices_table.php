<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrafficDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traffic_devices', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('traffictensor_id')->nullable();
            $table->foreign('traffictensor_id')->references('id')->on('traffic_tensors')->onDelete('cascade');
            $table->unsignedBigInteger('trafficpole_id')->nullable();
            $table->foreign('trafficpole_id')->references('id')->on('traffic_poles')->onDelete('cascade');
            $table->unsignedBigInteger('regulatorbox_id')->nullable();
            $table->foreign('regulatorbox_id')->references('id')->on('regulator_boxes')->onDelete('cascade');
            $table->unsignedBigInteger('device_id')->nullable();
            $table->foreign('device_id')->references('id')->on('devices_inventory')->onDelete('cascade');

            $table->string('code', 50)->unique();
            $table->string('state', 50);
            $table->string('type', 50)->nullable();
            $table->string('brand', 50)->nullable();
            $table->string('model', 50)->nullable();
            $table->text('comment')->nullable();
            $table->string('picture', 50)->nullable();
            $table->string('erp_code', 50)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traffic_devices');
    }
}
