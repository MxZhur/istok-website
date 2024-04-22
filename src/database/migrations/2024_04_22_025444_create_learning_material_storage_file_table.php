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
        Schema::create('learning_material_storage_file', function (Blueprint $table) {
            $table->foreignId('learning_material_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('storage_file_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['learning_material_id', 'storage_file_id'], 'learning_material_storage_file_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('learning_material_storage_file');
    }
};
