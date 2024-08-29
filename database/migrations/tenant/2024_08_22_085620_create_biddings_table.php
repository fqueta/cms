<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('biddings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('genre_id');
            $table->integer('phase_id');
            $table->string('title', 255);
            $table->string('subtitle', 255);
            $table->string('indentifier', 255);
            $table->text('description');
            $table->string('object', 255);
            $table->integer('order');
            $table->integer('bidding_category_id');
            $table->integer('type_id');
            $table->boolean('active');
            $table->string('type_doc',200);
            $table->dateTime('opening');
            $table->timestamps();});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biddings');
    }
};
