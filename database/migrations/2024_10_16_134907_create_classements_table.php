<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classements', function (Blueprint $table) {
            $table->id();
            
            // Code suivi lié à la table 'demandes'
            $table->string('code_suivi');
            $table->foreign('code_suivi')->references('code_suivi')->on('demandes')->onDelete('restrict');

            // Cabine liée à la table 'cabines'
            $table->unsignedBigInteger('cabine_id');
            $table->foreign('cabine_id')->references('id')->on('cabines')->onDelete('restrict');

            // Validation de la quittance par la caissière
            $table->boolean('est_valide')->default(false);

            // ID de l'utilisateur caissière qui valide la quittance
            $table->unsignedBigInteger('caissiere_id')->nullable();
            $table->foreign('caissiere_id')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classements');
    }
}
