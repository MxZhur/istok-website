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
        Schema::create('expert_club_entry_storage_file', function (Blueprint $table) {
            $table->foreignId('expert_club_entry_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('storage_file_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['expert_club_entry_id', 'storage_file_id'], 'expert_club_file_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expert_club_entry_storage_file');
    }
};
