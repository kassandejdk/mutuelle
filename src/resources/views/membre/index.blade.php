<x-dashbord.dashbord_body :membre="true">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Bienvenu cher membre</h4>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Demandes en cours</h6>
                                <div class="dropdown mb-2">
                                    <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                    </a>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{$demandes->count()}}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>+3.3%</span>
                                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Pret en cours</h6>
                                
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{ request()->user()->prets->where('reste_a_payer','>',0)->count()}}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-danger">
                                            <span>-2.8%</span>
                                            <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Mes prets</h6>
                                
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{ request()->user()->prets->count()}}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="text-success">
                                            <span>+2.8%</span>
                                            <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->
    <div class="row">
        <div class="row my-3">
            <x-session key="success"></x-session>
            <div class="col-8">
                <h1 class="">Mes demandes en cours</h1>
            </div>
            <div class="col-4">
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#createModal" id="createDemande">
                    <i class="mdi mdi-folder-plus"></i>
                    Demande
                </button>
            </div>
        </div>
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    @if (!$demandes->isEmpty())
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Numero</th>
                                        <th>Motif</th>
                                        <th>Montant</th>
                                        <th>statut</th>
                                        <th>Date</th>
                                        <th class="float-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demandes as $demande)
                                        <tr>
                                            <td class="fs-4 pt-4">{{ $loop->iteration }}</td>
                                            <td class="fs-4 pt-4">{{ $demande->motif }}</td>
                                            <td class="fs-4 pt-4">{{ getPrix($demande->montant) }}
                                            </td>
                                            <td @class([
                                                'fs-4',
                                                'pt-4',
                                                'text-success' => $demande->statut === 'accepter',
                                                'text-danger' => $demande->statut === 'rejeter',
                                            ])>
                                                {{ $demande->statut }}</td>
                                            <td class="fs-4 pt-4">{{ $demande->created_at->diffForHumans() }}</td>
                                            <td class="float-end">
                                                @if ($demande->contrat)
                                                    <button type="button" class="btn btn-info btn-icon"
                                                        title="voir le contrat" data-bs-toggle="modal"
                                                        data-bs-target="#ContratModal-{{ $demande->id }}">
                                                        <i data-feather="book-open"></i>
                                                    </button>

                                                    <!--Contrat Modal -->
                                                    <div class="modal fade" id="ContratModal-{{ $demande->id }}"
                                                        tabindex="-1" aria-labelledby="ContratModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="ContratModalLabel">
                                                                        Information sur mon contrat
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="btn-close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p class="fst-italic text-center mt-2">Genéré
                                                                        {{ $demande->contrat->created_at->diffForHumans() }}
                                                                    </p>
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <div class="form-group row my-2">
                                                                                <label for="inputEmail"
                                                                                    class="col-sm-3 col-form-label fs-4">
                                                                                    Montant
                                                                                </label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text"
                                                                                        class="form-control py-2 fs-4"
                                                                                        id="inputEmail"
                                                                                        value="{{ getPrix($demande->contrat->montant) }}"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row my-2">
                                                                                <label for="inputEmail"
                                                                                    class="col-sm-3 col-form-label fs-4">
                                                                                    Taux
                                                                                </label>
                                                                                <div class="col-sm-9">
                                                                                    <input type="text"
                                                                                        class="form-control py-2 fs-4"
                                                                                        id="inputEmail"
                                                                                        value="{{ $demande->contrat->taux }} %"
                                                                                        readonly>
                                                                                </div>
                                                                                <div class="form-group row my-2">
                                                                                    <label for="inputEmail"
                                                                                        class="col-sm-3 col-form-label fs-4">
                                                                                        Delais
                                                                                    </label>
                                                                                    <div class="col-sm-9">
                                                                                        <input type="text"
                                                                                            class="form-control py-2 fs-4"
                                                                                            id="inputEmail"
                                                                                            value="{{ $demande->contrat->delais }} "
                                                                                            readonly>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Fermer</button>
                                                                    <form
                                                                        action="{{ route('membre.pret.update', $demande->contrat) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" name="pret"
                                                                            value="{{ $demande->contrat->id }}">
                                                                        <input type="submit" value="Decliner"
                                                                            name="action" class="btn btn-danger">
                                                                        <input type="submit" value="Accepter"
                                                                            name="action" class="btn btn-success">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                @if ($demande->statut === 'en traitement')
                                                    <a href="{{ route('membre.demande.edit', $demande) }}"
                                                        class="btn btn-secondary btn-icon" title="supprimer"
                                                        id="moreBtn-{{ $demande->id }}">
                                                        <i data-feather="more-horizontal"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center py-3">Aucune demande de pret en cours</p>
                    @endif
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
            aria-hidden="true">
            <form action="{{ route('membre.demande.store') }}" class="forms" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Faire une demande de pret
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="btn-close"></button>
                        </div>
                        <div class="modal-body">
                            <x-demande-form></x-demande-form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                document.getElementById('createDemande')?.dispatchEvent(new Event('click'));
            })
        </script>
    @endif

</x-dashbord.dashbord_body>
<script src="{{ asset('admin/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('admin/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('admin/assets/js/data-table.js') }}"></script>
