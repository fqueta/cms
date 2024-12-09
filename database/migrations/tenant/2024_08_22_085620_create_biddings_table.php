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
            $table->integer('genre_id')->nullable();
            $table->integer('phase_id')->nullable();
            $table->string('title', 355)->nullable();
            $table->string('subtitle', 355)->nullable();
            $table->string('indentifier', 255)->nullable();
            $table->text('description')->nullable();
            $table->longText('object')->nullable();
            $table->integer('order')->nullable();
            $table->integer('bidding_category_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->integer('author_id')->nullable();
            $table->enum('active',['s','n']);
            $table->string('type_doc',200)->nullable();
            $table->dateTime('opening');
            // $table->enum('excluido',['n','s']);
            // $table->text('reg_excluido')->nullable();
            // $table->enum('deletado',['n','s']);
            // $table->text('reg_deletado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biddings');
    }
};
