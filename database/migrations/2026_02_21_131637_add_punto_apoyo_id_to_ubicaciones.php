<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ubicaciones', function (Blueprint $table) {
            $table->foreignId('punto_apoyo_id')->nullable()->constrained('puntos_apoyo')->nullOnDelete()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('ubicaciones', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\PuntoApoyo::class);
            $table->dropColumn('punto_apoyo_id');
        });
    }
};
