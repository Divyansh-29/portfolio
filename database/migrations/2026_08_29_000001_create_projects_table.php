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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable();
            $table->text('description');
            $table->json('tags')->nullable();
            $table->string('category')->nullable();
            $table->string('period')->nullable();
            $table->string('role_type')->nullable();
            $table->string('link')->nullable();
            $table->string('repo_link')->nullable();
            $table->string('art_type')->default('tax'); // 'tax', 'bhoomi', 'core', 'custom'
            $table->text('art_headline')->nullable();
            $table->boolean('is_featured')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

