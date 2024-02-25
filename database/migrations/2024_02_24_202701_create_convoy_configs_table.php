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
        Schema::create('convoy_configs', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Convoy::class);
            $table->foreignIdFor(\App\Models\Vehicle::class);
            $table->boolean('is_stockade')->default(false);
            $table->boolean('is_nightshark')->default(false);
            $table->boolean('is_u2r')->default(false);
            $table->integer('position')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convoy_configs');
    }
};
