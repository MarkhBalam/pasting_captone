<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('facility_project', function (Blueprint $table) {
            // Drop existing FKs (use array syntax if names differ)
            $table->dropForeign('facility_project_facility_id_foreign');
            $table->dropForeign('facility_project_project_id_foreign');

            $table->foreign('facility_id')
                  ->references('id')->on('facilities')
                  ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('project_id')
                  ->references('id')->on('projects')
                  ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('facility_project', function (Blueprint $table) {
            $table->dropForeign('facility_project_facility_id_foreign');
            $table->dropForeign('facility_project_project_id_foreign');

            $table->foreign('facility_id')
                  ->references('id')->on('facilities')
                  ->onUpdate('cascade')->onDelete('restrict');

            $table->foreign('project_id')
                  ->references('id')->on('projects')
                  ->onUpdate('cascade')->onDelete('restrict');
        });
    }
};
