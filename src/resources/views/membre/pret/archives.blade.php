<x-dashbord.dashbord_body :membre="true">
    <div class="row">
        <div class="row my-3">
            <x-session key="success"></x-session>
            <x-session key="error" type="danger"></x-session>
            <h1 class="">Mon historique de pret</h1>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            @if (!$prets->isEmpty())
                <div class="table-responsive w-100">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Montant</th>
                                <th>Taux</th>
                                <th>Total payer</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prets as $pret)
                                <tr>
                                    <td class="fs-4 pt-4">{{ $loop->first }}
                                    </td>

                                    <td class="fs-4 pt-4">
                                        {{ getPrix($pret->montant) }}
                                    </td>
                                    <td class="fs-4 pt-4">
                                        {{ $pret->taux }} %</td>
                                    <td class="fs-4 pt-4">{{ getPrix($pret->paiements->where('statut','valider')->sum('montant')) }}</td>
                                    <td class="fs-4 pt-4">
                                        {{ $pret->created_at->diffForHumans() }}
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            @else
            <p class="text-center py-5 fs-3 card">Votre historique est vide </p>
            @endif
        </div>
    </div>

</x-dashbord.dashbord_body>
