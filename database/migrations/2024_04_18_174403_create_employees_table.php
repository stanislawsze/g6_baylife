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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('phone')->nullable();
            $table->date('birthday')->nullable();
            $table->string('origines')->nullable();
            $table->string('pistol_sn')->nullable();
            $table->string('shotgun_sn')->nullable();
            $table->string('torch_sn')->nullable();
            $table->string('baton_sn')->nullable();
            $table->string('tazer_sn')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
