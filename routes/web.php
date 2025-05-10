
<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BatimentController;
use App\Http\Controllers\CabineController;
use App\Http\Controllers\demandeResidenceController;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\ClassementController;
use App\Http\Controllers\CritereController;
use App\Http\Controllers\PlanificationController;
use App\Http\Controllers\AnneeAcademiqueController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Groupe de routes nécessitant l'authentification et vérification par email
Route::middleware(['auth', 'verified'])->group(function () {

    // Route par défaut vers le tableau de bord

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Gestion des utilisateurs, rôles et permissions
    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
        Route::resource('/user-management/roles', RoleManagementController::class);
        Route::resource('/user-management/permissions', PermissionManagementController::class);
    });


    Route::prefix('gestion')->group(function () {
        // Gestion des cités
        Route::middleware(['chef_cite'])->group(function () {
            Route::name('cities.')->prefix('cities')->group(function () {
                Route::get('/', [CityController::class, 'index'])->name('index');
                Route::get('/create', [CityController::class, 'create'])->name('create');
                Route::post('/', [CityController::class, 'store'])->name('store');
                Route::get('/{id}', [CityController::class, 'show'])->name('show');
                Route::get('/{id}/edit', [CityController::class, 'edit'])->name('edit');
                Route::put('/{id}', [CityController::class, 'update'])->name('update');
                Route::delete('/{id}', [CityController::class, 'destroy'])->name('destroy');
            });
        });


        // Gestion des bâtiments
        Route::name('batiments.')->prefix('batiments')->group(function () {
            Route::get('/', [BatimentController::class, 'index'])->name('index');
            Route::get('/create', [BatimentController::class, 'create'])->name('create');
            Route::post('/', [BatimentController::class, 'store'])->name('store');
            Route::get('/{batiment}', [BatimentController::class, 'show'])->name('show');
            Route::get('/{batiment}/edit', [BatimentController::class, 'edit'])->name('edit');
            Route::put('/{batiment}', [BatimentController::class, 'update'])->name('update');
            Route::delete('/{batiment}', [BatimentController::class, 'destroy'])->name('destroy');
        });

        // Routes des années académiques
        Route::prefix('annees-academiques')->name('annees-academiques.')->group(function () {
            Route::get('/', [AnneeAcademiqueController::class, 'index'])->name('index');
            Route::get('/create', [AnneeAcademiqueController::class, 'create'])->name('create');
            Route::post('/', [AnneeAcademiqueController::class, 'store'])->name('store');
            Route::get('/{anneeAcademique}', [AnneeAcademiqueController::class, 'show'])->name('show');
            Route::get('/{anneeAcademique}/edit', [AnneeAcademiqueController::class, 'edit'])->name('edit');
            Route::put('/{anneeAcademique}', [AnneeAcademiqueController::class, 'update'])->name('update');
            Route::delete('/{anneeAcademique}', [AnneeAcademiqueController::class, 'destroy'])->name('destroy');
        });

        // Routes des planifications
        Route::prefix('planifications')->name('planifications.')->group(function () {
            Route::get('/', [PlanificationController::class, 'index'])->name('index');
            Route::get('/create', [PlanificationController::class, 'create'])->name('create');
            Route::post('/', [PlanificationController::class, 'store'])->name('store');
            Route::get('/{planification}', [PlanificationController::class, 'show'])->name('show');
            Route::get('/{planification}/edit', [PlanificationController::class, 'edit'])->name('edit');
            Route::put('/{planification}', [PlanificationController::class, 'update'])->name('update');
            Route::delete('/{planification}', [PlanificationController::class, 'destroy'])->name('destroy');
        });


        // Gestion des cabines
        Route::name('cabines.')->prefix('cabines')->group(function () {
            Route::get('/', [CabineController::class, 'index'])->name('index');
            Route::get('/create', [CabineController::class, 'create'])->name('create');
            Route::post('/', [CabineController::class, 'store'])->name('store');
            Route::get('/{cabine}', [CabineController::class, 'show'])->name('show');
            Route::get('/{cabine}/edit', [CabineController::class, 'edit'])->name('edit');
            Route::put('/{cabine}', [CabineController::class, 'update'])->name('update');
            Route::delete('/{cabine}', [CabineController::class, 'destroy'])->name('destroy');
        });
    });


    //Gestion des critères de répartition
    Route::resource('criteres', CritereController::class);
    Route::post('/classements/{codeSuivi}/validate', [ClassementController::class, 'validateClassement'])
        ->name('classements.validate');
    Route::get('/test-planification', [PlanificationController::class, 'ajouterTest']);

    // lancement du classement des demandes
    Route::get('/admin/demandes/classement', [DemandeResidenceController::class, 'lancerClassement'])->name('admin.demandes.classement');

    Route::post('/classements/{code_suivi}/validate', [ClassementController::class, 'valider'])
        ->name('classements.validate')
        ->middleware('auth');


    // Gestion des classements
    Route::prefix('classements')->name('classements.')->group(function () {
        Route::get('/', [ClassementController::class, 'index'])->name('index');
        Route::get('/create', [ClassementController::class, 'create'])->name('create');
        Route::post('/', [ClassementController::class, 'store'])->name('store');
        Route::get('/{code_suivi}', [ClassementController::class, 'show'])->name('show');
        Route::get('/{code_suivi}/edit', [ClassementController::class, 'edit'])->name('edit');
        Route::put('/{code_suivi}', [ClassementController::class, 'update'])->name('update');
        Route::delete('/{code_suivi}', [ClassementController::class, 'destroy'])->name('destroy');
    });




    // Gestion des demandes admin
    Route::get('admin/demandes', [DemandeResidenceController::class, 'admin_index'])->name('admin.demandes.index');
    Route::post('admin/demandes/filter', [DemandeResidenceController::class, 'filter'])->name('admin.demandes.filter');
});

// Gestion des demandes et de suivi

Route::get('/', [DemandeResidenceController::class, 'index']);
Route::get('/demande', [DemandeResidenceController::class, 'create'])->name('demandes.create');
Route::get('/demande/confirmation/{code_suivi}', [DemandeResidenceController::class, 'confirmation'])->name('demandes.confirmation');
Route::post('/demande', [DemandeResidenceController::class, 'store'])->name('demandes.store');
Route::get('/suivre', [DemandeResidenceController::class, 'suivre'])->name('suivre');
Route::post('/suivi-demande', [DemandeResidenceController::class, 'suivreDemande'])->name('suivi.demande');
Route::get('/suivi/demande/{code_suivi}', [DemandeResidenceController::class, 'afficherDemande'])->name('afficher.demande');


// Route pour la validation de la demande
Route::get('/validation/{code_suivi}', [ValidationController::class, 'validation'])->name('validation');
// Route pour la validation de la quittance
Route::get('/validation-quittance/{code_suivi}', [ValidationController::class, 'validerQuittance'])->name('validation.quittance');
Route::post('/submit-quittance/{code_suivi}', [ValidationController::class, 'storeQuittance'])->name('submit.quittance');
Route::get('/validation-recu-loyer/{code_suivi}', [ValidationController::class, 'validerRecuLoyer'])->name('validation.recu_loyer');
Route::post('/submit-recu/{code_suivi}', [ValidationController::class, 'storeRecu'])->name('submit.recu');


// Route pour la validation des pièces au CB
//Route::get('/validation/cb/{classement_id}', [ValidationController::class, 'validerCb'])->name('validation.cb');






// Route pour afficher une erreur personnalisée
Route::get('/error', function () {
    abort(500);
});

// Route pour l'authentification via les providers sociaux (ex : Google, Facebook)
Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

// Inclusion des routes d'authentification Laravel (connexion, inscription, mot de passe oublié, etc.)
require __DIR__ . '/auth.php';
