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
    Schema::create('demandes', function (Blueprint $table) {
        $table->id();
        $table->string('code_suivi')->unique();
        $table->enum('statut', ['En cours de traitement', 'Vous avez été classé'])->default('En cours de traitement'); // Correction ici
        $table->string('annee_etude');
        $table->string('filiere');
        $table->string('fiche_preinscription')->nullable(); // fichier uploadé

        // Relations
        $table->string('etudiant_matricule'); // FK vers etudiants
        $table->foreign('etudiant_matricule')->references('matricule')->on('etudiants')->onDelete('cascade');

        $table->unsignedBigInteger('etablissement_id');
        $table->foreign('etablissement_id')->references('id')->on('etablissements')->onDelete('cascade');

        $table->unsignedBigInteger('planification_id');
        $table->foreign('planification_id')->references('id')->on('planifications')->onDelete('cascade');

        $table->foreignId('verification_matricule_id')->constrained()->onDelete('cascade');
        $table->timestamps();

        // Contrainte : une seule demande par planification pour un même étudiant
        $table->unique(['etudiant_matricule', 'planification_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
