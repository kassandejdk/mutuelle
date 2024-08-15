@php
    use App\Models\User;
    use App\Models\Demande;
@endphp
<x-dashbord.dashbord_body >
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
      <div class="row ">
        @if(session('success'))
          <div class="alert fermerAlerte alert-success fs-4 d-flex justify-content-between alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close btn-noboot" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true" >&times;</span>
            </button>
          </div>
          <script>
            const alertFermer=document.querySelector('.fermerAlerte');
              setTimeout(() => {
                    alertFermer.remove(); 
              },4000)
          </script>
        @endif
        <div class="col-lg-12">
          <h4 class="mb-3 mb-md-0">Liste des prets en cours </h4>
        </div>
  
        <div class="col-md-12 grid-margin stretch-card mt-3">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title">LISTE COMPLETE</h6>
              <div class="table-responsive">
                <table id="dataTableExample" class="table">
                  <thead>
                    <tr>
                      <th>Nom-Prenom </th>
                      <th>Montant</th>
                      <th>Reste a payer</th>
                      <th>Taux(%)</th>
                      <th>Delai</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                     
                    @foreach ($prets as $key => $pret )
                    <tr>
                      <td>{{ User::find(Demande::find($pret->demande_id)->user_id)->nom }} {{  User::find(Demande::find($pret->demande_id)->user_id)->nom }}</td>
                      <td>{{ $pret->montant }}</td>
                      <td>{{ $pret->reste_a_payer }}</td>
                      <td>{{ $pret->taux }} </td>
                      <td>{{ $pret->delais }}</td>
                      <td>
                        <button type="button" class="btn btn-warning btnPad " data-toggle="modal" data-target="#detailPret{{ $pret->id }}">
                            <i class="bi bi-three-dots"></i>
                        </button>
                       
                      </td>
                      
                    </tr>
                   <!-- Modal -->
                    <div class="modal fade" id="detailPret{{ $pret->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Paiements</h5>
                            <button type="button" class="close btn-noboot" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            @if ($pret->paiements->isEmpty())
                                <div class="alert alert-info text-center fs-5" role="alert">
                                Aucun remboursement effectué pour ce prêt.
                                </div>
                            @else
                                @foreach ($pret->paiements as $paiement)
                                <div class="card mb-3">
                                    <div class="card-body">
                                    <h5 class="card-title">Paiement - {{ $paiement->token }}</h5>
                                    <p class="card-text"><strong>Montant:</strong> {{ $paiement->montant }}</p>
                                    <p class="card-text"><strong>Statut:</strong> {{ $paiement->statut }}</p>
                                    <p class="card-text"><strong>Date:</strong> {{ $paiement->created_at }}</p>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            </div>
                            <div class="modal-footer">
                            <button class="btn btn-primary" type="button" data-dismiss="modal">Fermer</button>
                            </div>
                        </div>
                        </div>
                    </div> 
                  @endforeach
                  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
  
    {{-- </div> --}}
  <style>
    .btn-noboot{
      background: none !important;
      border: none !important;
      color: inherit !important;
      padding: 0 !important;
      font: inherit !important;
      cursor: pointer !important;
      outline: inherit !important;
    }
    .form-group label{
      /* font-weight: 500 !important; */
      text-transform: uppercase !important;
    }
    @media (min-width: 768px) {
      .pdf-download-link {
        display: none;
      }
    }
  
    @media (max-width: 767px) {
      .pdf-embed {
        display: none;
      }
    }
  </style>
    
  </x-dashbord.dashbord_body>
  
  <script src="{{ asset('admin/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('admin/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
  <script src="{{ asset('admin/assets/js/data-table.js') }}"></script>
  
  