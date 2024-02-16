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
        Schema::create('convoy_user_cancellation_reasons', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Convoy::class);
            $table->foreignIdFor(\App\Models\User::class);
            $table->string('cancellation_reason');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convoy_user_cancellation_reasons');
    }
};
