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
        Schema::create('tag_teaching_material', function (Blueprint $table) {
            $table->foreignId('teaching_material_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['teaching_material_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_teaching_material');
    }
};
