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
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('planification_id')->constrained('planifications')->onDelete('restrict'); // Ajout de la relation
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone');
            $table->string('email');
            $table->date('date_naissance');
            $table->string('lieu_naissance');
            $table->string('domicile');
            $table->string('etablissement');
            $table->string('filiere');
            $table->string('annee_etude');
            $table->string('fiche_inscription');
            $table->enum('sexe', ['M', 'F']);
            $table->string('nationalite');
            $table->string('adresse_personnelle');
            $table->string('statut_aide');
            $table->boolean('salarie')->default(false);
            $table->boolean('ancien_resident')->default(false);
            $table->string('batiments')->nullable();
            $table->boolean('redoublant')->default(false);
            $table->string('adresse_residence_parents');
            $table->boolean('handicap')->default(false);
            $table->string('type_handicap')->nullable();
            $table->string('certificat_handicap')->nullable();
            $table->string('code_suivi')->unique();
            $table->enum('statut', ['En cours de traitement', 'Vous avez été classé'])->default('En cours de traitement'); // Correction ici
            $table->timestamps();
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
