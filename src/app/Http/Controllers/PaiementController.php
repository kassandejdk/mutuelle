<?php

namespace App\Http\Controllers;

use App\Models\Pret;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PaiementController extends Controller
{
    private function getTransID()
    {
        return "TransId".date('Ymd-His').rand(1,10000);
    }

    private function giveServices(Paiement $paiement)
    {   
        
        $paiement->pret->reste_a_payer-=$paiement->montant;
        $paiement->save();
    }

    public function create(Request $request,Pret $pret)
    {
        // dd($pret);
        $request->validate([
            'montant'=>['required','numeric','min:1',"max:$pret->reste_a_payer"]
        ]);
        if($request->montant<100)   return back()->with('error','Le montant minimum est de 100 XOF');
        $user=$request->user();
        $transId=$this->getTransID();
        // dd($plan,$this->getTransID());

        $HEADERS=[
            'Apikey'=>env('LIGDICASH_API_KEY'),
            'Authorization'=>'Bearer '.env('LIGDICASH_TOKEN'),
            'Accept'=>'application/json',
            'Content-Type'=>'application/json',
        ];
        // dd($HEADERS);
        $payload = [
            "commande" => [
                "invoice" => [
                    "items" => [
                        [
                            "name" => "Remboursement pret #$pret->id",
                            "description" => "Paiement pret #$pret->id",
                            "quantity" => 1,
                            "unit_price" => $request->input('montant'),
                            "total_price" => $request->input('montant'),
                        ]
                    ],
                    "total_amount" => $request->input('montant'),
                    "devise" => "XOF",
                    "description" => "Paiement pour remboursement de pret #$pret->id",
                    "customer" => "$user->telephone", // Format : 22676275726 or 22997761182
                    "customer_firstname" => "$user->nom",
                    "customer_lastname" => "$user->prenom",
                    "customer_email" => "$user->email",
                    "external_id" => "",
                    "otp" => "" // Laisser vide si non applicable
                ],
                "store" => [
                    "name" => "SENSEI E-SCHOOL",
                    "website_url" => "http://127.0.0.1:8000/"
                ],
                "actions" => [
                    "cancel_url" => route('membre.pret.paiement.cancel_url',$transId),
                    "return_url" => route('membre.pret.paiement.return_url',$transId),
                    "callback_url" => route('membre.pret.paiement.callback_url',$transId)
                ],
                "custom_data" => [
                    "transaction_id" => "$transId"
                ]
            ]
        ];
        // /** @var  Response*/
        try {
            $response=Http::withHeaders($HEADERS)->asJson()->post(env('LIGDICASH_PAY_IN_ENDPOINT'),$payload);
        } catch (\Exception $e) {
        return back()->with('error','Une erreur s\'est produite');
            
        }
        if($response->successful()){
            $data=$response->json();
            if ($data['response_code']==='00'){
                // dd($data);
                Paiement::create([
                    'transId'=>$transId,
                    'token'=> $data['token'],
                    'montant'=>$request->input('montant'),
                    'statut'=>'en attente',
                    'pret_id'=>$pret->id
                ]);
                return redirect($data['response_text']);
            }
        }
        return back()->with('error','Une erreur s\'est produite');
    }

    /**
     * Show the form for creating a new resource.
     */
    
    
    public function cancel_url(Request $request,Paiement $paiement)
    {
        if ($paiement->statut!=='valider') $paiement->update(['statut'=>'anuller']);
        return back()->with('error','Vous avez annuler la paiement');
    }

    public function return_url(Request $request,Paiement $paiement)
    {
        $HEADERS=[
            'Apikey'=>env('LIGDICASH_API_KEY'),
            'Authorization'=>'Bearer '.env('LIGDICASH_TOKEN'),
            'Accept'=>'application/json',
            'Content-Type'=>'application/json',
        ];
        // dd(env('LIGDICASH_VERIF_ENDPOINT').$trans->token);
        if( $paiement->statut !=='valider')
        {
            $response=Http::withHeaders($HEADERS)->get(env('LIGDICASH_VERIF_ENDPOINT').$paiement->token);
            if($response->successful()){
                $data=$response->json();
                if ($data['response_code']==='00')
                {
                    $paiement->update([
                        'statut'=>'valider'
                    ]);
                    $this->giveServices($paiement);
                } else return back()->with('error','une erreur s\'est produite');
            }else return back()->with('error','une erreur s\'est produite');
        }
        return to_route('membre.pret.index')->with('success','Paiement reussi');
        
    }

    public function callback_url(Request $request)
    {
        $payload = $request->getContent();
        $event = json_decode($payload);
 
        $token = $event->token;
        $transaction_id = $event->transaction_id;
        $status = $event->status;
 
        $paiement = Paiement::where('token', $token)->first(); // Ou avec le transaction_id ou tout autre identifiant unique
 
        if ($paiement->statut === "en attente" && $status === "completed") {
            // Mettre à jour le statut de la paiement dans la base de données
            $paiement->statut = "valider";
            $paiement->save();
            // Livrer le produit ou valider la commande
            $this->giveServices($paiement);
        }
    }
}
