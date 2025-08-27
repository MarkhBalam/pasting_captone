<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location')->nullable();
            $table->text('description')->nullable();
            $table->string('partner_organization')->nullable();
            $table->string('facility_type')->nullable();
            $table->json('capabilities')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('facilities'); }
};
