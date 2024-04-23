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
        Schema::create('storage_file_teaching_material', function (Blueprint $table) {
            $table->foreignId('teaching_material_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('storage_file_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['teaching_material_id', 'storage_file_id'], 'teaching_material_storage_file_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storage_file_teaching_material');
    }
};
