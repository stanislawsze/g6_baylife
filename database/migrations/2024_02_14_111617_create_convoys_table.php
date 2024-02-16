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
        Schema::create('convoys', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_started')->default(0);
            $table->boolean('is_finished')->default(0);
            $table->foreignIdFor(\App\Models\User::class);
            $table->integer('convoy_amount')->default(0);
            $table->timestamp('start_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convoys');
    }
};
