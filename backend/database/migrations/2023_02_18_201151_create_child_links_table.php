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
        Schema::create('child_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('base_id')->references('id')->on('base_links')->onDelete('cascade')->onUpdate('cascade');
            $table->string('link');
            $table->integer('clicks')->default(0);
            $table->integer('max_clicks')->default(0);
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
        Schema::dropIfExists('child_links');
    }
};
