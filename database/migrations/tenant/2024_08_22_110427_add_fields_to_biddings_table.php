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
        Schema::table('biddings', function (Blueprint $table) {


            $table->integer('year')->nullable();
            $table->string('token', 255)->nullable();
            $table->json('config')->nullable();
            $table->enum('excluido',['n','s'])->after('opening')->nullable();
            $table->enum('deletado',['n','s'])->after('excluido')->nullable();
            $table->longtext('reg_exluido')->after('deletado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biddings', function (Blueprint $table) {
            // $table->dropColumn('excluido');
            // $table->dropColumn('deletado');
            // $table->dropColumn('reg_exluido');
        });
    }
};
