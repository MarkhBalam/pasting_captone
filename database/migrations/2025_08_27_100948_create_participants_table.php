<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete(); // one project per participant
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('affiliation')->nullable();     // CS, SE, Engineering
            $table->string('specialization')->nullable();  // Software, Hardware, Business
            $table->boolean('cross_skill_trained')->default(false);
            $table->string('institution')->nullable();     // SCIT, CEDAT, etc.
            $table->string('role_on_project')->nullable(); // Student, Lecturer, Contributor
            $table->string('skill_role')->nullable();      // Developer, Engineer, Designer
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('participants'); }
};
