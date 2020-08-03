<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrafficLightTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traffic_lights', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('devices_inventory')->onDelete('cascade');
            $table->unsignedBigInteger('intersection_id');
            $table->foreign('intersection_id')->references('id')->on('intersections')->onDelete('cascade');
            $table->unsignedBigInteger('tensor_id')->nullable();
            $table->foreign('tensor_id')->references('id')->on('traffic_tensors')->onDelete('cascade');
            $table->unsignedBigInteger('pole_id')->nullable();
            $table->foreign('pole_id')->references('id')->on('traffic_poles')->onDelete('cascade');
            $table->unsignedBigInteger('regulator_id');
            $table->foreign('regulator_id')->references('id')->on('regulator_boxes')->onDelete('cascade');

            $table->string('code', 50)->unique()->nullable();
            $table->string('brand', 50);
            $table->string('model')->nullable();
            $table->string('state');
            $table->string('light_folder', 50)->nullable();
            $table->string('picture', 50);
            $table->string('orientation', 20);
            $table->string("fastener", 50)->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('traffic_lights');
    }
}
