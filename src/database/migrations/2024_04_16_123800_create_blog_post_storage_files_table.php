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
        Schema::create('blog_post_storage_file', function (Blueprint $table) {
            $table->foreignId('blog_post_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('storage_file_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->unique(['blog_post_id', 'storage_file_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_post_storage_file');
    }
};
