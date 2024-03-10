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
        Schema::table('going_on_duties', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Vehicle::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('going_on_duties', function (Blueprint $table) {
            $table->dropColumn('vehicle_id');
        });
    }
};
