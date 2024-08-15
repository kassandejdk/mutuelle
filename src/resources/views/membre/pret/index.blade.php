<x-dashbord.dashbord_body :membre="true">
    <div class="row">
        <div class="row my-3">
            <x-session key="success"></x-session>
            <x-session key="error" type="danger"></x-session>
            <h1 class="">Mes prets en cours</h1>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    @if (!$prets->isEmpty())
                        <div class="row">
                            @foreach ($prets as $pret)
                                <div class="card text-white bg-dark col-md-5  my-2 mx-md-3 ">
                                    <div class="card-header text-center">Mon pret Numero {{ $loop->iteration }}</div>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <div class="row text-primary">
                                                <div class="col-6">Reste a payer </div>
                                                <div class="col-6 fs-4">
                                                    {{ getPrix($pret->reste_a_payer) }}</div>
                                            </div>
                                        </h5>
                                        <div class="card-text">
                                            <div class="row mb-2">
                                                <div class="col-6 fst-italic">Montant</div>
                                                <div class="col-6">{{ getPrix($pret->montant) }}
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6 fst-italic">Taux</div>
                                                <div class="col-6">10 %</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6 fst-italic">Delais</div>
                                                <div class="col-6">{{ $pret->delais }}</div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#historiqueModal-{{ $pret->id }}"
                                                id="btn-{{ $pret->id }}"
                                                class="btn btn-info me-3 px-2 w-25">historique</button>
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#payementModal-{{ $pret->id }}"
                                                id="btn-{{ $pret->id }}" class="btn btn-success w-25">Payer</button>
                                        </div>
                                    </div>
                                </div>
                                <!--Historique Modal -->
                                <div class="modal fade" id="historiqueModal-{{ $pret->id }}" tabindex="-1"
                                    aria-labelledby="historiqueModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="historiqueModalLabel">Mes paiements</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="btn-close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if (!$pret->paiements->isEmpty())
                                                    <div class="table-responsive">
                                                        <table id="dataTableExample" class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>TransId</th>
                                                                    <th>Montant</th>
                                                                    <th>Statut</th>
                                                                    <th>Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($pret->paiements->sortByDesc('created_at') as $paiement)
                                                                    <tr>
                                                                        <td class="fs-4 pt-4">{{ $paiement->transId }}
                                                                        </td>

                                                                        <td class="fs-4 pt-4">
                                                                            {{ getPrix($paiement->montant) }}
                                                                        </td>
                                                                        <td @class(['fs-4','pt-4', 'text-success' => $paiement->statut==='valider','text-danger' => $paiement->statut==='annuler'])>
                                                                            {{ $paiement->statut }}</td>
                                                                        <td class="fs-4 pt-4">
                                                                            {{ $paiement->created_at->diffForHumans() }}
                                                                        </td>

                                                                    </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @else
                                                    <p class="text-center py-3">Aucun paiement n'a été éffectué </p>
                                                    <button type="button" class="btn btn-primary d-block w-50 mx-auto"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#payementModal-{{ $pret->id }}">Faire un
                                                        paiement</button>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Fermer</button>
                                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#payementModal-{{ $pret->id }}">Rembourser</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!--Payement Modal -->
                                <div class="modal fade" id="payementModal-{{ $pret->id }}" tabindex="-1"
                                    aria-labelledby="payementModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="payementModalLabel">Mes paiements</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="btn-close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form action="{{ route('membre.pret.paiement.create',$pret)}}" method="post">
                                                            @csrf
                                                            <label for="montant" class="form-label">Montant de
                                                                remboursement</label>
                                                            <input type="number" class="form-control fs-4" id="montant"
                                                                placeholder="{{ $pret->reste_a_payer }}" name="montant"
                                                                value="{{ old('montant') }}" min="0"
                                                                max="{{ $pret->reste_a_payer }}" required>
                                                            @error('montant')
                                                                <label class="text-danger">{{ $message }}</label>
                                                            @enderror
                                                            <input type="submit" value="Payer"
                                                                class="btn btn-primary w-100 mx-auto mt-3">
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Fermer</button>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        </tbody>
                        </table>
                </div>
            @else
            <p class="text-center py-5 fs-3">Aucun  pret en cours </p>
            @endif
            </div>
        </div>
    </div>

</x-dashbord.dashbord_body>
