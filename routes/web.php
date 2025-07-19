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
use App\Http\Controllers\DemandeResidenceController;
use App\Http\Controllers\ValidationController;
use App\Http\Controllers\ClassementController;
use App\Http\Controllers\CritereController;
use App\Http\Controllers\PlanificationController;
use App\Http\Controllers\AnneeAcademiqueController;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\FedapayController;
use App\Http\Controllers\BaseUacController;
use App\Http\Controllers\VerificationMatriculeController;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
        Route::resource('/user-management/roles', RoleManagementController::class);
        Route::resource('/user-management/permissions', PermissionManagementController::class);
    });

    Route::prefix('gestion')->group(function () {

        Route::middleware(['intendant'])->group(function () {
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

        Route::middleware(['intendant'])->group(function () {
            Route::name('batiments.')->prefix('batiments')->group(function () {
                Route::get('/', [BatimentController::class, 'index'])->name('index');
                Route::get('/create', [BatimentController::class, 'create'])->name('create');
                Route::post('/', [BatimentController::class, 'store'])->name('store');
                Route::get('/{batiment}', [BatimentController::class, 'show'])->name('show');
                Route::get('/{batiment}/edit', [BatimentController::class, 'edit'])->name('edit');
                Route::put('/{batiment}', [BatimentController::class, 'update'])->name('update');
                Route::delete('/{batiment}', [BatimentController::class, 'destroy'])->name('destroy');
            });
        });

        Route::middleware(['intendant'])->group(function () {
            Route::prefix('annees-academiques')->name('annees-academiques.')->group(function () {
                Route::get('/', [AnneeAcademiqueController::class, 'index'])->name('index');
                Route::get('/create', [AnneeAcademiqueController::class, 'create'])->name('create');
                Route::post('/', [AnneeAcademiqueController::class, 'store'])->name('store');
                Route::get('/{anneeAcademique}', [AnneeAcademiqueController::class, 'show'])->name('show');
                Route::get('/{anneeAcademique}/edit', [AnneeAcademiqueController::class, 'edit'])->name('edit');
                Route::put('/{anneeAcademique}', [AnneeAcademiqueController::class, 'update'])->name('update');
                Route::delete('/{anneeAcademique}', [AnneeAcademiqueController::class, 'destroy'])->name('destroy');
            });
        });

        Route::middleware(['intendant'])->group(function () {
            Route::prefix('etablissements')->name('etablissements.')->group(function () {
                Route::get('/', [EtablissementController::class, 'index'])->name('index');
                Route::get('/create', [EtablissementController::class, 'create'])->name('create');
                Route::post('/', [EtablissementController::class, 'store'])->name('store');
                Route::get('/{etablissement}', [EtablissementController::class, 'show'])->name('show');
                Route::get('/{etablissement}/edit', [EtablissementController::class, 'edit'])->name('edit');
                Route::put('/{etablissement}', [EtablissementController::class, 'update'])->name('update');
                Route::delete('/{etablissement}', [EtablissementController::class, 'destroy'])->name('destroy');
            });
        });

        Route::middleware(['intendant'])->group(function () {
        Route::name('base_uac.')->prefix('base-uac')->group(function () {
                Route::get('/', [BaseUacController::class, 'index'])->name('index');
                Route::get('/ajouter', [BaseUacController::class, 'create'])->name('create');
                Route::post('/ajouter', [BaseUacController::class, 'store'])->name('store');
            });
        });


        Route::middleware(['intendant'])->group(function () {
            Route::prefix('planifications')->name('planifications.')->group(function () {
                Route::get('/', [PlanificationController::class, 'index'])->name('index');
                Route::get('/create', [PlanificationController::class, 'create'])->name('create');
                Route::post('/', [PlanificationController::class, 'store'])->name('store');
                Route::get('/{planification}', [PlanificationController::class, 'show'])->name('show');
                Route::get('/{planification}/edit', [PlanificationController::class, 'edit'])->name('edit');
                Route::put('/{planification}', [PlanificationController::class, 'update'])->name('update');
                Route::delete('/{planification}', [PlanificationController::class, 'destroy'])->name('destroy');
            });
        });

        Route::middleware(['intendant'])->group(function () {
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

    });

    Route::resource('criteres', CritereController::class);
    Route::post('/classements/{codeSuivi}/validate', [ClassementController::class, 'validateClassement'])->name('classements.validate');
    Route::get('/test-planification', [PlanificationController::class, 'ajouterTest']);

    Route::middleware(['intendant'])->group(function () {
        Route::get('/admin/demandes/classement', [DemandeResidenceController::class, 'lancerClassement'])->name('admin.demandes.classement');
        Route::get('/demandes/export/pdf', [DemandeResidenceController::class, 'exportPdf'])->name('demandes.export.pdf');
        Route::post('/classements/liberer', [ClassementController::class, 'libererCabinesNonValidees'])->name('classements.liberer');
        Route::get('/classements/export-pdf', [ClassementController::class, 'exportPdf'])->name('admin.classements.export.pdf');
    });
    Route::middleware(['caissiere'])->group(function () {
        Route::post('/classements/{code_suivi}/validate', [ClassementController::class, 'valider'])->name('classements.validate')->middleware('auth');
    });

    Route::middleware(['chef_batiment'])->group(function () {
        Route::prefix('classements')->name('classements.')->group(function () {
            Route::get('/', [ClassementController::class, 'index'])->name('index');

            Route::middleware(['caissiere'])->group(function () {
                Route::get('/create', [ClassementController::class, 'create'])->name('create');
                Route::post('/', [ClassementController::class, 'store'])->name('store');
                Route::get('/{code_suivi}', [ClassementController::class, 'show'])->name('show');
                Route::get('/{code_suivi}/edit', [ClassementController::class, 'edit'])->name('edit');
                Route::put('/{code_suivi}', [ClassementController::class, 'update'])->name('update');
                Route::delete('/{code_suivi}', [ClassementController::class, 'destroy'])->name('destroy');
            });
        });
    });

    Route::middleware(['intendant'])->group(function () {
        Route::get('admin/demandes', [DemandeResidenceController::class, 'admin_index'])->name('admin.demandes.index');
        Route::post('admin/demandes/filter', [DemandeResidenceController::class, 'filter'])->name('admin.demandes.filter');
    });
});


Route::get('/', [DemandeResidenceController::class, 'index']);
Route::get('/demande/simple', [DemandeResidenceController::class, 'createSimple'])
    ->middleware('matricule.verifie')
    ->name('demandes.create.simple');

Route::post('/demande/simple', [DemandeResidenceController::class, 'storeSimple'])
    ->middleware('matricule.verifie')
    ->name('demandes.store.simple');

Route::get('/demande', [DemandeResidenceController::class, 'create'])
    ->middleware('matricule.verifie')
    ->name('demandes.create');

Route::post('/demande', [DemandeResidenceController::class, 'store'])
    ->middleware('matricule.verifie')
    ->name('demandes.store');

Route::get('/demande2', [DemandeResidenceController::class, 'create2'])
    ->middleware('matricule.verifie')
    ->name('demandes2.create');


Route::get('/demande/confirmation/{code_suivi}', [DemandeResidenceController::class, 'confirmation'])->name('demandes.confirmation');

Route::get('/suivre', [DemandeResidenceController::class, 'suivre'])->name('suivre');
Route::post('/suivi-demande', [DemandeResidenceController::class, 'suivreDemande'])->name('suivi.demande');
Route::get('/suivi/demande/{code_suivi}', [DemandeResidenceController::class, 'afficherDemande'])->name('afficher.demande');

Route::get('/validation/{code_suivi}', [ValidationController::class, 'validation'])->name('validation');
Route::get('/validation-quittance/{code_suivi}', [ValidationController::class, 'validerQuittance'])->name('validation.quittance');
Route::post('/submit-quittance/{code_suivi}', [ValidationController::class, 'storeQuittance'])->name('submit.quittance');
Route::get('/validation-recu-loyer/{code_suivi}', [ValidationController::class, 'validerRecuLoyer'])->name('validation.recu_loyer');
Route::post('/submit-recu/{code_suivi}', [ValidationController::class, 'storeRecu'])->name('submit.recu');

Route::post('/make-payment/{classement_id}', [FedapayController::class, 'make_payment'])->name('paiement.make');
Route::get('/payment/callback/{classement_id}', [FedapayController::class, 'callback_kkiapay'])->name('paiement.callback');
Route::get('/payementsucces', [FedapayController::class, 'payementsucces'])->name('paiement.success');

Route::get('/verification-matricule', [VerificationMatriculeController::class, 'showForm'])->name('verification_matricule.form');
Route::post('/verification-matricule', [VerificationMatriculeController::class, 'handleMatricule'])->name('verification_matricule.check');
Route::post('/verification-code', [VerificationMatriculeController::class, 'verifyCode'])->name('verification_matricule.verify_code');

Route::get('/verif/logout', function () {
    session()->forget('matricule_verifie');
    return redirect()->route('verification_matricule.form')
        ->with('success', 'Vous avez été déconnecté avec succès.');
})->name('verification_matricule.logout');


Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
