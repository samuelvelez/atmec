<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_report', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('report_id')->unsigned()->index();
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');

            $table->unsignedBigInteger('material_id');
            $table->foreign('material_id')->references('id')->on('devices_inventory')->onDelete('cascade');

            $table->unsignedBigInteger('metric_id')->unsigned()->index();
            $table->foreign('metric_id')->references('id')->on('metric_units')->onDelete('cascade');

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
        Schema::dropIfExists('material_report');
    }
}
