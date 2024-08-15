
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
          <h4 class="mb-3 mb-md-0">Liste des prets en cours</h4>
        </div>
  
        <div class="col-md-12 grid-margin stretch-card mt-3">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title">LISTE COMPLETE</h6>
              <div class="table-responsive">
                <table id="dataTableExample" class="table">
                  <thead>
                    <tr>
                      <th>Matricule </th>
                      <th>Montant</th>
                      <th>Reste a payer</th>
                      <th>Taux</th>
                      <th>Actions</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                     
                    @foreach ($prets as $pret )
                    <tr>
                      <td>{{ Auth::user()->matricule }}</td>
                      <td>{{ $pret->montant }}</td>
                      <td>{{ $pret->reste_a_payer }}</td>
                      <td>{{ $user->taux }}</td>
                      <td>
                        <button type="button" class="btn-noboot " data-toggle="modal" data-target="#">
                          <i class="bi bi-three-dots"></i>
                        </button>
                      </td>
                      <!-- Modal de detail d'un membre -->
                      <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="voirplusLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="voirplusLabel">Detail d'inscription</h5>
                              <button type="button" class="close btn-noboot" data-dismiss="modal" aria-label="Close" style="scale: 1.5">
                                <span aria-hidden="true" style="scale:2">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                <div class="col-lg-3">
                                  <img src="{{ asset('admin/assets/images/user.jpg') }}" style="max-width:150px;max-height:150px" alt="">
                                </div>
                                <div class="col-lg-9">
                                  <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nom de famille</label>
                                    <input type="text" class="form-control" id="nameFamille" value="{{  }}">
                                  </div>
                                  <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Prenom</label>
                                    <input type="text" class="form-control" id="prenom" value="{{  }}">
                                  </div>
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Email</label>
                                <input type="text" class="form-control" id="emailDetail" value="{{  }}">
                              </div>
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Telephone</label>
                                <input type="text" class="form-control" id="phoneDetail" value="{{  }}">
                              </div>
                              
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-toggle="modal" data-dismiss="modal">Fermer</button>
                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#declinerModal">Decliner</button>
                              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#raisonModal">Renvoyer</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </tr>
  
                  @endforeach
                  
                  </tbody>
                </table>
              </div>
            </div>
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
  
  