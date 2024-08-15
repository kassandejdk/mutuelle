@php
    use App\Models\User;
    use App\Models\Pret;
    use App\Models\Demande;
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport Financier</title>
   
</head>
<body>
    <h1>Rapport Financier</h1>
    <p><strong>Date :</strong> {{ date('d-m-Y') }}</p>
    <p><strong>Généré par :</strong> {{ Auth::user()->nom }} {{ Auth::user()->prenom }}</p>
    
    <table border="1" cellspacing="0" cellpadding="8">
        <thead>
            <tr>
                <th>Nom-Prenom</th>
                <th>Montant</th>
                <th>Reste a payer</th>
                <th>Delai</th>
                <th>Date de prise</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paiements as $paiement)
                <tr>
                    <td>{{ User::find(Demande::find(Pret::find($paiement->pret_id)->demande_id)->user_id)->nom }} {{ User::find(Demande::find(Pret::find($paiement->pret_id)->demande_id)->user_id)->prenom }}</td>
                    <td>{{ $paiement->montant }}</td>
                    <td>{{ Pret::find($paiement->pret_id)->taux }}</td>
                    <td>{{ Pret::find($paiement->pret_id)->delais }}</td>
                    <td>{{ Carbon::parse($paiement->created_at)->isoFormat('LL') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td><strong>Total</strong></td>
                <td>{{ $total }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
