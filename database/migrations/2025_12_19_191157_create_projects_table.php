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

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->longText('long_description')->nullable();
            $table->string('image')->nullable();
            $table->string('github_url')->nullable();
            $table->string('live_url')->nullable();

            $table->json('technologies')->nullable();

            $table->string('status')->default('completed');
            $table->boolean('published')->default(true);
            $table->integer('order')->default(0)->index();

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
