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
        Schema::create('cabines', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Code de la cabine
            $table->foreignId('batiment_id')->constrained()->onDelete('cascade'); // Clé étrangère vers la table batiments
            $table->integer('places_initiales'); // Nombre de places initiales
            $table->integer('places_disponibles'); // Nombre de places disponibles
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabines');
    }
};
