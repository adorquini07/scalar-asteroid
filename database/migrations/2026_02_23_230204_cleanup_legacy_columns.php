<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->dropColumn(['puesto_votacion', 'mesa_votacion']);
        });

        Schema::table('registros', function (Blueprint $table) {
            $table->dropColumn(['referido', 'mesa_vota']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personas', function (Blueprint $table) {
            $table->string('puesto_votacion')->nullable();
            $table->string('mesa_votacion')->nullable();
        });

        Schema::table('registros', function (Blueprint $table) {
            $table->string('referido')->nullable();
            $table->integer('mesa_vota')->nullable();
        });
    }
};
