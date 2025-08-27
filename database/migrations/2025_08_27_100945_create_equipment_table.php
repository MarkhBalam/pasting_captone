<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('facility_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('name');
            $table->text('capabilities')->nullable();
            $table->text('description')->nullable();
            $table->string('inventory_code')->nullable()->index();
            $table->string('usage_domain')->nullable();
            $table->string('support_phase')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('equipment'); }
};
