<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('alert_id')->unsigned()->index()->nullable(true);
            $table->foreign('alert_id')->references('id')->on('alerts')->onDelete('cascade');

            $table->unsignedBigInteger('status_id')->unsigned()->index();
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');

            $table->unsignedBigInteger('novelty_id')->unsigned()->index();
            $table->foreign('novelty_id')->references('id')->on('novelties')->onDelete('cascade');

            $table->unsignedBigInteger('subnovelty_id')->unsigned()->index();
            $table->foreign('subnovelty_id')->references('id')->on('novelties')->onDelete('cascade');

            $table->unsignedBigInteger('worktype_id')->unsigned()->index();
            $table->foreign('worktype_id')->references('id')->on('novelties')->onDelete('cascade');

            $table->json('pictures')->nullable(true);
            $table->text('description');

            $table->timestamp('readed_on')->nullable(true);
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
        Schema::dropIfExists('reports');
    }
}
