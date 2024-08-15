<?php

namespace App\Http\Controllers;

use App\Models\Pret;
use Illuminate\Http\Request;
use App\Models\Demande;

class PretController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $prets=$request->user()->prets->where('reste_a_payer','>',0)->load('paiements');
        return view('membre.pret.index',['prets'=>$prets]);
    }
    public function archives(Request $request)
    {
        $prets=$request->user()->prets->where('reste_a_payer','<=',0)->load('paiements');
        return view('membre.pret.archives',['prets'=>$prets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)

    {

       $data=$request->validate([
            'montant'=>'required|numeric|min:100',
            'delais'=>"required|after:now",
            'taux'=>'required|numeric|min:0|max:100|',
            'demande_id'=>'required|exists:demandes,id',
        ]);

        $demande=Demande::findOrFail($request->input('demande_id'));
        $demande->statut='accepter';
        $demande->save();
        $data['reste_a_payer']=$request->input('montant');
        Pret::create($data);
        return redirect()->back()->with('success',"Le pret a été generé avec succes !!!");
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
    public function show(pret $pret)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pret $pret)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pret $pret)
    {
        $request->validate([
            'pret'=>['required','exists:prets,id'],
            'action'=>['required','in:Accepter,Decliner']
        ]);
        $pret->est_accepter=$request->action==='Accepter';
        $pret->save();
        return back()->with('success','Operation effectuée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pret $pret)
    {
        //
    }

    public function pretRunning(){
        $prets=Pret::where('est_accepter','true')->where('reste_a_payer','!=',0)->get();
        return view('dashbord.pret_run',compact('prets'));
    }

   
}
