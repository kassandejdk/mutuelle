<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $users=User::whereNotNull('matricule')
            ->whereDoesntHave('roles', function ($query) {
                $query->where('id', 5);
            })
            ->get();
            
        return view('dashbord.membre',compact('users'));
        
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
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $request->validate([
            'matricule' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'telephone' => 'nullable|string|max:20',
        ]);
        try{
        $user = User::findOrFail($id);
        $user->matricule = $request->input('matricule');
        $user->nom = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->email = $request->input('email');
        $user->telephone = $request->input('telephone');
        $user->save();
        
        return back()->with('success', 'Les informations de l\'utilisateur ont été mises à jour avec succès.');
    } catch (\Exception $e) {
        return back()->with('error', 'Erreur de modification des informations de l\'utilisateur.');
    }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    
    public function delete($id){
        $user=User::findOrFail($id);
        $user->delete();
        return back()->with('success',"L'utilisateur a été supprimé");
    }
    public function destroy(string $id)
    {
        $user=User::findOrFail($id);
        $user->roles()->attach(5);
        $sujet = "Désactivation de votre compte GestMutuelle";
        $message = "<p>Bonjour <strong>{$user->prenom}</strong>,</p>
            <p>
            Cher utilisateur, votre compte a été désactiver de la plateforme. Si vous estimez qu'il s'agit d'une erreur, veuillez prendre contact avec l'administrateur de la mutuelle.
        Cordialement.
            </p> ";
        try {
            Mail::html($message, function ($message) use ($user, $sujet) {
                $message->to($user->email)
                        ->subject($sujet);
            });
            
            return redirect()->back()->with('success', 'L\'utilisateur a été banni de votre mutuelle et un email l\'a été envoyé.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'envoi de l\'email.');
        }
    }

    public function envoyerEmail(Request $request, $id)
    {
        $request->validate([
            'raison' => 'nullable|string|max:1000',
        ]);

        $user = User::findOrFail($id);
       

        if ($request->filled('raison')) {
            $sujet = "Probleme d'inscription";
            $raison = $request->input('raison');
            $message = "<p>Bonjour <strong>{$user->prenom}</strong>,</p>
            <p>
            Nous avons examiné votre demande d'inscription et malheureusement, elle n'est pas complète. Veuillez revoir les informations suivantes :
            </p>
            <p style='color: red;'><strong>{$raison}</strong></p>
            <p>
            Merci de vous reconnecter en tenant compte de ces suggestions.
            Le lien du site : <a href='".route('login')."'>GestMutuelle</a> <br/>
            </p>
            <p>Cordialement,<br>Signé par GestMutuelle.</p>
            ";
        } else {
            $sujet = "Inscription reussie";
            $message = "<p>Bonjour <strong>{$user->prenom}</strong>,</p>
            <p>Félicitations ! Votre inscription a été validée avec succès. Vous pouvez maintenant accéder à votre compte avec le matricule suivant:<br/></p>
            <p style='color:blue;'><strong>{$user->matricule}</strong></p>
            <p>
            Le numéro matricule est personnel et confidentiel ne le communiquez donc pas à une tierce personne <br/>
            Le lien du site: <a href='".route('login')."'>GestMutuelle</a>
            </p>

            <p>Cordialement, <br/>
            Signé par GestMutuelle.
            </p>
            ";
        }

        try {
            Mail::html($message, function ($message) use ($user, $sujet) {
                $message->to($user->email)
                        ->subject($sujet);
            });
            if ($request->filled('raison')) {
                $user->delete();
            }
            return redirect()->back()->with('success', 'Email envoyé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'envoi de l\'email.');
        }
    }

    public function envoyerMatricule($id){
        $matricule=User::getMatricule();
        $user=User::findOrFail($id);
        $user->matricule=$matricule;
        $user->save();
        $request = new Request();
        $request->setMethod('POST');
        $request->merge(['raison' => null]); 
        $this->envoyerEmail($request, $id);
        return redirect()->back()->with('success',"Le matricule a été généré et l'email de confirmation a été envoyé");
    }

    public function voirPlus($id){
        
        $user=User::findOrFail($id);
        $prets=$user->prets;   
        return view('dashbord.voir_plus',compact('prets','user'));
    }


    public function membreBannit(){
        $membres = User::whereHas('roles',function($query){
            $query->where('id',5);
        })->get(); 
    //    dd($membres);
        return view('dashbord.membre_bannit', compact('membres'));
    }
}
