<?php

use App\Http\Controllers\FraisController;
use App\Http\Controllers\FraisHFController;
use App\Http\Controllers\VisiteurController;
use Illuminate\Support\Facades\Route;

// -------------------------- Accueil --------------------------
Route::get('/', function () {return view('home');});

// -------------------------- Visiteur --------------------------
Route::get('/connecter', [VisiteurController::class, 'login']);
Route::post('/autentifier', [VisiteurController::class, 'auth']);
Route::get('/deconnecter', [VisiteurController::class, 'logout']);

// -------------------------- Frais --------------------------

Route::get('/listerFrais', [FraisController::class, 'listFrais']);
Route::get('/ajouterFrais', [FraisController::class, 'addFrais']);
Route::get('/editerFrais/{id}', [FraisController::class, 'editFrais']);
Route::post('/validerFrais', [FraisController::class, 'validFrais']);
Route::get('/supprimerFrais/{id}', [FraisController::class, 'removeFrais']);

// -------------------------- FraisHF --------------------------

Route::get('/listerFraisHF/{id}', [FraisHFController::class, 'listFraisHF']);
Route::get('/ajouterFraisHF/{id}', [FraisHFController::class, 'addFraisHF']);
Route::get('/editerFraisHF/{idHF}', [FraisHFController::class, 'editFrais']);
Route::post('/validerFraisHF', [FraisHFController::class, 'validFrais']);

//
