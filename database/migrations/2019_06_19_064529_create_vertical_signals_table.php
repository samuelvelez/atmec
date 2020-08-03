<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerticalSignalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vertical_signals', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('signal_id');
            $table->foreign('signal_id')->references('id')->on('signals_inventory')->onDelete('cascade');
            $table->unsignedBigInteger('variation_id')->nullable();
            $table->foreign('variation_id')->references('id')->on('signal_variations')->onDelete('cascade');

            $table->string('code', 50)->unique();
            $table->decimal('latitude', 11, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('signal_folder', 50)->nullable();
            $table->string('picture', 50);
            $table->text('comment')->nullable();
            $table->string('orientation', 20);
            $table->text('google_address');
            $table->string("street1")->nullable();
            $table->string("street2")->nullable();
            $table->string("neighborhood")->nullable();
            $table->string("parish")->nullable();
            $table->string("state");
            $table->string("normative");
            $table->string("fastener");
            $table->string("material");
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
        Schema::dropIfExists('vertical_signals');
    }
}
