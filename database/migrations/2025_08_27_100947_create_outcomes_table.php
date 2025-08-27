<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('outcomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('artifact_link')->nullable();
            $table->string('outcome_type');                 // CAD, PCB, Prototype, Report, Plan
            $table->string('quality_certification')->nullable();
            $table->string('commercialization_status')->nullable(); // Demoed, Linked, Launched
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('outcomes'); }
};
