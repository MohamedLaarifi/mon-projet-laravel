<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthAdminController,
    ClientController,
    AdminController,
    ContactController,
    DemandeDevisController,
    OffreERPController,
    ChatbotController,
    DashboardController

};

//chatbot

Route::post('/chatbot', [ChatbotController::class, 'ask']);


// 📌 Routes publiques (accessibles sans authentification)
Route::apiResource('clients', ClientController::class);
Route::get('offres', [OffreERPController::class, 'index']);
Route::get('offres/{offre}', [OffreERPController::class, 'show']);
Route::post('demandes', [DemandeDevisController::class, 'store']);
Route::get('demandes/{id}', [DemandeDevisController::class, 'show']);

// 📌 Contact : le client envoie un message (publique)
Route::post('contacts', [ContactController::class, 'store']);

// 📌 Authentification Admin
Route::post('admin/login', [AuthAdminController::class, 'login']);

// 📌 Routes protégées par sanctum pour les admins
Route::middleware('auth:admin')->group(function () {
    Route::post('admin/logout', [AuthAdminController::class, 'logout']);
    Route::get('admin/profile', [AuthAdminController::class, 'profile']);
    Route::get('dashboard/stats', [DashboardController::class, 'stats']);
    Route::apiResource('admins', AdminController::class);

    // Gestion des contacts : admin peut voir, répondre, supprimer
    Route::get('contacts', [ContactController::class, 'index']);
    Route::get('contacts/{id}', [ContactController::class, 'show']);
    Route::put('contacts/{id}', [ContactController::class, 'update']);
    Route::delete('contacts/{id}', [ContactController::class, 'destroy']);

    // Gestion des demandes de devis (admin uniquement)
    Route::get('demandes', [DemandeDevisController::class, 'index']);
    Route::put('demandes/{id}', [DemandeDevisController::class, 'update']);
    Route::delete('demandes/{id}', [DemandeDevisController::class, 'destroy']);
    Route::post('demandes/{id}/accepter', [DemandeDevisController::class, 'accepter']);

    // Gestion des offres
    Route::post('offres', [OffreERPController::class, 'store']);
    Route::put('offres/{offre}', [OffreERPController::class, 'update']);
    Route::delete('offres/{offre}', [OffreERPController::class, 'destroy']);
});
