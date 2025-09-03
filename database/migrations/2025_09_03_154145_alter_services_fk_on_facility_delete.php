<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            // drop current FK (RESTRICT)
            $table->dropForeign(['facility_id']);
            // add CASCADE
            $table->foreign('facility_id')
                  ->references('id')->on('facilities')
                  ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign(['facility_id']);
            // revert to RESTRICT (default)
            $table->foreign('facility_id')
                  ->references('id')->on('facilities')
                  ->onDelete('restrict')->onUpdate('cascade');
        });
    }
};
