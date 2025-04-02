<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('annees_academiques', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique(); // Ex: "2024-2025"
            $table->date('date_debut');
            $table->date('date_fin');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annees_academiques');
    }
};
