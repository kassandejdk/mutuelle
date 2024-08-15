@php
    use App\Models\User;
    use App\Models\Pret;
    use App\Models\Demande;
    use Carbon\Carbon;
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
        <div class="col-12 col-xl-12 stretch-card">
          <div class="row flex-grow-1">
              <div class="col-md-4 grid-margin stretch-card">
                  <div class="card">
                      <div class="card-body">
                          <div class="d-flex justify-content-between align-items-baseline">
                              <h6 class="card-title mb-0">Le nombre de pret accordes</h6>
                              <div class="dropdown mb-2">
                                  <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                      aria-haspopup="true" aria-expanded="false">
                                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                  </a>
                                  
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-6 col-md-12 col-xl-5">
                                  <h3 class="mb-2">{{ $nbrePret }}</h3>
                                  <div class="d-flex align-items-baseline">
                                      <p class="text-success">
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
                              <h6 class="card-title mb-0">Le nombre de paiements</h6>
                              
                          </div>
                          <div class="row">
                              <div class="col-6 col-md-12 col-xl-5">
                                  <h3 class="mb-2 mt-2">{{ $nbrePaiement }}</h3>
                                  <div class="d-flex align-items-baseline">
                                     
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
                              <h6 class="card-title mb-0">Total de reste a payer</h6>
                              
                          </div>
                          <div class="row">
                              <div class="col-6 col-md-12 col-xl-9">
                                  <h4 class="mb-2 mt-2">{{ getPrix($reste) }}</h4>
                                  
                              </div>
                             
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <div class="container fs-5">
            <h1 class="my-4">Rapport Financier</h1>
            <p><strong>Date :</strong> {{ date('d-m-Y') }}</p>
            <p><strong>Généré par :</strong> {{ Auth::user()->nom }} {{ Auth::user()->prenom }}</p>
            <form method="GET" action="{{ route('rapport.financier') }}">
              <select name="periode" id="choix" class="form-select fs-5" style="width: 150px;" onchange="this.form.submit()">
                <option value="tout" {{ request('periode') == 'tout' ? 'selected' : '' }}>Tout</option>
                <option value="mensuel" {{ request('periode') == 'mensuel' ? 'selected' : '' }}>Mensuel</option>
                <option value="annuel" {{ request('periode') == 'annuel' ? 'selected' : '' }}>Annuel</option>
              </select>
            </form>
            <div class="row mb-4">
              <div class="col-md-12 grid-margin stretch-card mt-3">
                <div class="card">
                  <div class="card-body">
                    <h6 class="card-title">LISTE COMPLETE</h6>
                    <div class="table-responsive">
                      <table id="dataTableExample" class="table">
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
                           
                          @foreach ($paiements as $key => $paiement )
                          <tr>
                            <td>{{ User::find(Demande::find(Pret::find($paiement->pret_id)->demande_id)->user_id)->nom }} {{ User::find(Demande::find(Pret::find($paiement->pret_id)->demande_id)->user_id)->prenom }} </td>
                            <td>{{ $paiement->montant }}</td>
                            <td>{{ Pret::find($paiement->pret_id)->taux }}</td>
                            <td>{{ Pret::find($paiement->pret_id)->delais }}</td>
                            <td>{{ Carbon::parse($paiement->created_at)->isoFormat('LL') }}</td>
                          </tr>
                        @endforeach
                        
                        </tbody>
                        <tfoot>
                          <tr style="color:rgb(3, 253, 41);font-weight:800" class="fs-5">
                            <td >Total</td>
                            <td>{{ $total }}</td>
                            
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="footer">
                <a href="{{ route('telecharger.rapport', ['periode' => request('periode','tout')]) }}" class="btn btn-primary mt-3"><i class="bi bi-download"></i>Télécharger</a>
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
 