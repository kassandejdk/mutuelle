<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use Illuminate\View\View;
use Illuminate\Http\Request;

class MembreController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function home(Request $request):View
     {
         // dd($request->user()->prets);
         // dd(Demande::find(4)->contrat);
         $demandes=$request->user()->demandes->load('contrat')->reject(function($demande){ return $demande->contrat?->est_accepter!==NULL;});
         return view('membre.index',['demandes'=>$demandes]);
     }
 
     public function prets(Request $request)
     {
         $prets=$request->user()->prets;
         return view('membre.pret.index',['prets'=>$prets]);
     }
    public function index()
    {
        //
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
    public function show(Membre $membre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Membre $membre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Membre $membre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Membre $membre)
    {
        //
    }

   
}
