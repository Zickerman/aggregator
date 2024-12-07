<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->string('url', length: 128)->unique();
            $table->smallInteger('http_response')->unsigned()->nullable();
            $table->text('response')->nullable();
            $table->smallInteger('frequency')->unsigned();
            $table->integer('retries')->unsigned();
            $table->smallInteger('delay')->unsigned();
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('urls_to_check');
    }
};
