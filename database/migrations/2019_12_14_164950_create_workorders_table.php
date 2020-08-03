<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workorders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('report_id')->unsigned()->index()->nullable(true);
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('cascade');

            $table->unsignedBigInteger('collector_id')->unsigned()->index()->nullable(true);
            $table->foreign('collector_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('status_id')->unsigned()->index();
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');

            $table->unsignedBigInteger('priority_id')->unsigned()->index();
            $table->foreign('priority_id')->references('id')->on('priorities')->onDelete('cascade');

            $table->json('pictures')->nullable(true);
            $table->text('description')->nullable(true);
            $table->text('complete_description')->nullable(true);


            $table->timestamp('started_on')->nullable(true);
            $table->timestamp('completed_on')->nullable(true);
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
        Schema::dropIfExists('workorders');
    }
}
