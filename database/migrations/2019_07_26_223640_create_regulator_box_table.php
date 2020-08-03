<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegulatorBoxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regulator_boxes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('intersection_id');
            $table->foreign('intersection_id')->references('id')->on('intersections')->onDelete('cascade');

            $table->string('code', 50)->unique()->nullable();
            $table->string('brand')->nullable();
            $table->string('state');
            $table->decimal('latitude', 11, 8);
            $table->decimal('longitude', 11, 8);
            $table->text('google_address');
            $table->string('picture_in')->nullable();
            $table->string('picture_out')->nullable();
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
        Schema::dropIfExists('regulator_boxes');
    }
}
