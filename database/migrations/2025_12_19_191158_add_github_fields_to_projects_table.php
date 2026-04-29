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
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('github_id')->nullable()->unique()->after('id');
            $table->string('name')->nullable()->after('github_id');
            $table->string('html_url')->nullable()->after('name');
            $table->string('language')->nullable()->after('html_url');
            $table->unsignedInteger('stargazers_count')->default(0)->after('language');
            $table->unsignedInteger('forks_count')->default(0)->after('stargazers_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['github_id', 'name', 'html_url', 'language', 'stargazers_count', 'forks_count']);
        });
    }
};

