<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandeFormRequest;
use App\Models\Demande;
use App\Models\Justificatif;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    use AuthorizesRequests;
    // public function __construct() {
    //     $this->authorizeResource(Demande::class,'demande');
    // }
    private function store_justificatifs(Array $justificatifs,Demande $demande): void
    {
        foreach($justificatifs as $justificatif){
            Justificatif::create([
                "libelle"=>$justificatif['label'],
                "fichier"=>$justificatif['file']->store('JUSTIFICATIFS','public'),
                "demande_id"=>$demande->id
            ]);
        }

    }
    /**
     * Display a listing of the resource.
     */
    public function refuser(Demande $demande){
        $demande->update(['statut'=>'rejeter']);
        return back()->with('success','Cette demande a été rejeté avec succes!!!');
    }
    
    public function index()
    {
        $demandes = Demande::where('statut','en traitement')->with('user')->get();
        return view('dashbord.demande', compact('demandes'));
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
    public function store(DemandeFormRequest $request)
    {
        $data=$request->validated();
        $demande=Demande::create($data);
        $request->whenFilled('justificatifs', function($justificatifs) use ($demande)  {
            $this->store_justificatifs($justificatifs,$demande);
        });
        return back()->with('success','Votre demande de pret a ete envoyé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Demande $demande)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Demande $demande)
    {
        $this->authorize('update',$demande);
        return view('membre.pret.demande',['demande'=>$demande->load('justificatifs')]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DemandeFormRequest $request, Demande $demande)
    {
        $this->authorize('update',$demande);
        $data=$request->validated();
        $demande->update($data);
        $request->whenFilled('justificatifs', function($justificatifs) use ($demande)  {
            $this->store_justificatifs($justificatifs,$demande);
        });
        return back()->with('success','Votre demande de pret a ete modifie avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demande $demande)
    {
        $this->authorize('delete',$demande);
        $demande->delete();
        return to_route('membre.home')->with('success','Votre demande de pret a ete supprimé avec succès');
    }
}



