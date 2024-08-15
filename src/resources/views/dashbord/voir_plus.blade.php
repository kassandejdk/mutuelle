@php
    use App\Models\Demande;
@endphp

<x-dashbord.dashbord_body >
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script> --}}
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
        <div class="col-lg-12 d-flex gap-2 align-items-center" style="padding: 1px; margin-left:12px;">
          <p>
            <a href="{{ route('liste.membre') }}" class="btn btn-outline-primary">
              <i class="link-icon" data-feather="arrow-left-circle"></i> retour
            </a>
          </p>
          <h4 class="mb-3 mb-md-0">Details sur les prêts de <strong>{{ $user->nom }} {{ $user->prenom }}</strong></h4>
        </div>
  
        <div class="container mt-3">
          <div class="row fs-5">
              @if ($prets->isEmpty())
              <div class="col-lg-12">
                  <div class="alert alert-info fs-5">
                      Aucun prêt pour cet utilisateur.
                  </div>
              </div>
              @else
              @foreach ($prets as $key => $pret)
              <div class="col-md-6 mb-3">
                  <div class="card border-primary">
                      <div class="card-header bg-primary text-white">
                          <h5 class="card-title">Pret #{{ $key + 1 }}</h5>
                      </div>
                      <h4 style="padding:12px 0 0 23px;font-style:italic;"><span style="font-weight:400;font-style:italic;">Motif: </span>{{ Demande::find($pret->demande_id)->motif }}</h4>
                      <div class="card-body">
                          <p class="card-text"><strong>Montant:</strong> {{ $pret->montant }}</p>
                          <p class="card-text"><strong>Reste à payer:</strong> {{ $pret->reste_a_payer }}</p>
                          <p class="card-text"><strong>Taux:</strong> {{ $pret->taux }}</p>
                          <p class="card-text"><strong>Délais:</strong> {{ $pret->delais }}</p>
                          <p class="card-text"><strong>Statut:</strong> {{ $pret->est_accepter }}</p>
                          <button type="button" class="btn btn-outline-primary btn-block mt-3" data-toggle="modal" data-target="#voirpaiement{{ $pret->id }}">
                              Voir paiements
                          </button>
                      </div>
                  </div>
              </div>
      
              <!-- Modal -->
              <div class="modal fade" id="voirpaiement{{ $pret->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Paiements</h5>
                              <button type="button" class="close btn-noboot" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                                  <thead>
                                      <tr>
                                          <th>Token</th>
                                          <th>Montant</th>
                                          <th>Statut</th>
                                          <th>Date</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @if ($pret->paiements->isEmpty())
                                      <tr>
                                          <td colspan="5" class="text-center">Aucun remboursement effectué pour ce prêt.</td>
                                      </tr>
                                      @else
                                      @foreach ($pret->paiements as $paiement)
                                      <tr>
                                          <td>{{ $paiement->token }}</td>
                                          <td>{{ $paiement->montant }}</td>
                                          <td>{{ $paiement->statut }}</td>
                                          <td>{{ $paiement->created_at }}</td>
                                      </tr>
                                      @endforeach
                                      @endif
                                  </tbody>
                                  <tfoot>
                                      <tr>
                                          <td colspan="5" class=" alert-info">
                                              <button class="btn btn-primary" type="button" data-dismiss="modal">Fermer</button>
                                          </td>
                                      </tr>
                                  </tfoot>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>

              @if (($key + 1) % 2 == 0)
              <div class="w-100"></div>
              @endif
              @endforeach
              @endif
          </div>
      </div>
      
      
      
      
      
      </div>

  <style>
    .btn-noboot{
      background: none !important;
      border: none !important;
      color: inherit !important;
      padding: 0 !important;
      font: inherit !important;
      cursor: pointer !important;
      outline: inherit !important;
      scale: 1.5;
    }
    .form-group label{
      text-transform: uppercase !important;
    }
    .btnPad{
        padding: .6rem !important;
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
  
  