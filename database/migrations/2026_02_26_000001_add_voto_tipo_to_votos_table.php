<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('votos', function (Blueprint $table) {
            $table->enum('voto_tipo', ['camara', 'senado', 'ambas'])->default('ambas')->after('mesa');
        });
    }

    public function down(): void
    {
        Schema::table('votos', function (Blueprint $table) {
            $table->dropColumn('voto_tipo');
        });
    }
};
