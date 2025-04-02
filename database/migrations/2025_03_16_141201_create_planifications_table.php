<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('planifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('annee_academique_id')->constrained('annees_academiques')->onDelete('restrict'); // Correction ici
            $table->date('date_debut');
            $table->date('date_fin');
            $table->enum('statut', ['ouverte', 'fermée'])->default('fermée');
            $table->text('description');
            $table->foreignId('cree_par')->constrained('users')->onDelete('cascade'); // L'intendant qui crée la planification
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('planifications');
    }
};
