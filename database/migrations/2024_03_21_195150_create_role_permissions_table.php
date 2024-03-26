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
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\DiscordRole::class);
            $table->boolean('convoy_manager')->default(false);
            $table->boolean('atm_manager')->default(false);
            $table->boolean('team_manager')->default(false);
            $table->boolean('salary_manager')->default(false);
            $table->boolean('role_manager')->default(false);
            $table->boolean('webhook_manager')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
    }
};
