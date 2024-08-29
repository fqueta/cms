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
            $table->enum('excluido',['n','s'])->after('opening');
            $table->enum('deletado',['n','s'])->after('excluido');
            $table->longtext('reg_exluido')->after('deletado')->nulable();
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
