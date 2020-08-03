<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItorderMaterialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itorder_material', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('itorder_id')->unsigned()->index();
            $table->foreign('itorder_id')->references('id')->on('itorders')->onDelete('cascade');

            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('devices_inventory')->onDelete('cascade');

            $table->unsignedBigInteger('metric_id')->unsigned()->index();
            $table->foreign('metric_id')->references('id')->on('metric_units')->onDelete('cascade');

            $table->string('code', 20);
            $table->integer('amount')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itorder_material');
    }
}
