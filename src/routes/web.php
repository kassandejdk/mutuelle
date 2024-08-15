<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PretController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MembreController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\JustificatifController;


Route::get('/',[MainController::class,'home'])->name('home');
Route::get('/se-connecter',[MainController::class,'index'])->name('dashbord.accueil');
Route::get('/inscription',[MainController::class,'inscription'])->name('dashbord.inscription');

Route::prefix('operateur/')->group(function (){ 

    Route::get('dashboard',[MainController::class,'dashbord'])->name('dashbord.dashbord');
    Route::delete('bannir/user/{id}',[UserController::class,'destroy'])->name('bannir.user');
    Route::post('envoyer/email/{id}',[UserController::class,'envoyerEmail'])->name('envoyer.email');
    Route::get('envoyer/matricule/{id}',[UserController::class,'envoyerMatricule'])->name('envoyer.matricule');
    
    Route::get('liste/membre',[UserController::class,'index'])->name('liste.membre');
    Route::delete('delete/user/{id}',[UserController::class,'delete'])->name('delete.user');
    Route::post('edit/user/{id}',[UserController::class,'edit'])->name('edit.user');
    Route::get('voir/plus/membre/{id}',[UserController::class,'voirPlus'])->name('voir.plus.membre');
    
    Route::get('voir/demande/',[DemandeController::class,'index'])->name('voir.demande');
    Route::get('delete/demande/pret/{id}',[DemandeController::class,'destroy'])->name('delete.demande.pret');
    Route::post('creer/pret',[PretController::class,'create'])->name('creer.pret');
    
    Route::get('refuser/pret/{demande}',[DemandeController::class,'refuser'])->name('refuser.demande');
    Route::get('membre/bannit/',[UserController::class,'membreBannit'])->name('membre.bannit');
    Route::get('pret/en-cours/',[PretController::class,'pretRunning'])->name('pret.run');
    Route::get('rapport/financier/',[MainController::class,'rapport'])->name('rapport.financier');
    Route::post('contacter/nous/',[ContactController::class,'store'])->name('contacter.nous');
    Route::get('commentaire/',[ContactController::class,'index'])->name('voir.commentaire');
    Route::delete('delete/commentaire/{contact}',[ContactController::class,'destroy'])->name('delete.commentaire');
    Route::get('telecharger/rapport/',[MainController::class,'telechargerRapport'])->name('telecharger.rapport');
});

Route::prefix('membre/')->controller(MembreController::class)->name('membre.')->middleware('auth')->group(function(){
    Route::get('/','home')->name('home');
    Route::resource('demande',DemandeController::class)->except(['create','index']);
    Route::get('demande-justificatif/{justificatif}/destroy',[JustificatifController::class,'destroy'])->name('justificatif.destroy');
    Route::get('pret/archives',[PretController::class,'archives'])->name('pret.archive');
    Route::resource('pret',PretController::class)->except(['create','destroy','edit','store']);
    Route::prefix('pret/paiement/')->controller(PaiementController::class)->name('pret.paiement.')->group(function(){
        Route::post('{pret}/','create')->name('create');
        Route::get('cancel/{paiement}/','cancel')->name('cancel_url');
        Route::match(['GET','POST'],'return/{paiement}/','return_url')->name('return_url');
        Route::post('callback/{paiement}/','callback_url')->name('callback_url');
    });
});

Route::resource('demande',DemandeController::class)->except(['create']);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
