   function lancerClassement()
    {
        DB::transaction(function () {
           // 🔹 Récupérer la dernière planification avec description "Lancement d'inscription"
            $planification = Planification::where('description', 'Lancement d\'inscription')
            ->orderBy('created_at', 'desc')
            ->first();

            if (!$planification) {
            throw new \Exception("Aucune planification d'inscription trouvée.");
            }

            // 🔹 Vérifier que la planification appartient à la dernière année académique
            $anneeAcademique = AnneeAcademique::orderBy('id', 'desc')->first(); // ou 'created_at' selon le modèle

            if (!$anneeAcademique) {
            throw new \Exception("Aucune année académique trouvée.");
            }

            // 🔹 Récupérer les demandes éligibles (pas encore classées), sans handicap et liées à l'année académique courante
            $demandes = Demande::where('planification_id', $planification->id)
            ->whereHas('planification', function ($query) use ($anneeAcademique) {
             $query->where('annee_academique_id', $anneeAcademique->id);
            })
            ->where('handicap', false) // Supposons que ce champ indique la situation de handicap (booléen)
            ->whereDoesntHave('classement') // Exclure celles déjà classées
            ->get();

            if ($demandes->isEmpty()) {
            throw new \Exception("Aucune demande éligible trouvée.");
            }

            // 🔹 Calculer le score pour chaque demande
            $demandes = $demandes->map(function ($demande) {
                $score = 0;

                // Critère 1 : Âge (plus jeune = meilleur score)
                $age = now()->diffInYears($demande->date_naissance);
                $score += (100 - $age); // Moins on est âgé, plus le score est élevé.

                // Critère 2 : Ancienneté en cabine
                if ($demande->ancien_resident) {
                    $score -= 20; // Malus si déjà résident.
                }

                // Critère 3 : Statut financier
                if ($demande->boursier || $demande->secouru) {
                    $score += 20; // Bonus pour étudiants en difficulté financière.
                } elseif ($demande->salarie) {
                    $score -= 50; // Malus pour les salariés.
                }

                // Critère 4 : Redoublement
                if ($demande->redoublant) {
                    $score -= 20; // Malus si redoublant.
                }

                // Sauvegarde du score temporaire (non en BDD)
                $demande->score = $score;
                return $demande;
            });

            // 🔹 Trier les demandes par score décroissant
            $demandes = $demandes->sortByDesc('score');

            // 🔹 Récupérer les cabines disponibles
            $cabines = Cabine::where('places_disponibles', '>', 0)->with('batiment')->get();

            if ($cabines->isEmpty()) {
                throw new \Exception("Aucune cabine disponible.");
            }

            // 🔹 Répartition des cabines
            foreach ($demandes as $demande) {
                // Trouver une cabine du même sexe
                $cabineAttribuee = $cabines->first(function ($cabine) use ($demande) {
                    return $cabine->batiment->sexe === $demande->sexe && $cabine->places_disponibles > 0;
                });

                if ($cabineAttribuee) {
                    // 🔹 Créer le classement
                    Classement::create([
                        'code_suivi' => $demande->code_suivi,
                        'cabine_id' => $cabineAttribuee->id,
                        'est_valide' => false, // Non validé par défaut
                        'caissiere_id' => null
                    ]);

                    // 🔹 Décrémenter les places disponibles
                    $cabineAttribuee->decrement('places_disponibles');

                    // 🔹 Supprimer cette cabine si pleine
                    if ($cabineAttribuee->places_disponibles <= 0) {
                        $cabines = $cabines->reject(fn($c) => $c->id === $cabineAttribuee->id);
                    }
                }
            }
        });

        return redirect()->route('classements.index')->with('success', 'Répartition faite avec succès.');
    }
