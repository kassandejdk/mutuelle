<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paiement;
use App\Models\Pret;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Collection;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return View('dashbord.connexion');
    }

    public function inscription(){
        return view('dashbord.inscription');
    }
    public function dashbord(){

        $demandeInscriptions=User::demandeInscription();
        return view('dashbord.index',compact('demandeInscriptions'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function rapport(Request $request)
{
    $periode = $request->input('periode', 'tout'); 
    $paiements = Paiement::query();
    $prets=Pret::query();
    if ($periode === 'mensuel') {
        $paiements->whereMonth('created_at', now()->month)
                  ->whereYear('created_at', now()->year);
        $prets->whereMonth('created_at', now()->month)
              ->whereYear('created_at', now()->year);
    } elseif ($periode === 'annuel') {
        $paiements->whereYear('created_at', now()->year);
        $prets->whereYear('created_at', now()->year);
    }
    
    $paiements->where('statut', 'completed');
    $nbrePret=$prets->count();
    $reste=$prets->where('reste_a_payer','!=',0)->sum('reste_a_payer');
    $nbrePaiement=$paiements->count();
    $paiements = $paiements->get();
    $total = $paiements->sum('montant');
    return view('dashbord.rapport', compact('paiements', 'total','nbrePret','nbrePaiement','reste'));
}


  

    public function home(){
        return view('home');
    }

    

    public function telechargerRapport(Request $request)
    {
        $periode = $request->input('periode', 'tout'); 
        $paiements = Paiement::query();
    
        if ($periode === 'mensuel') {
            $paiements->whereMonth('created_at', now()->month)
                      ->whereYear('created_at', now()->year);
        } elseif ($periode === 'annuel') {
            $paiements->whereYear('created_at', now()->year);
        }
    
        $paiements->where('statut', 'completed');
        $paiements = $paiements->get();
        $total = $paiements->sum('montant');
        $pdf = Pdf::loadView('dashbord.rapport_pdf', compact('paiements', 'total'));
        return $pdf->download('rapport_financier.pdf'.now());
    }
    
    
}
