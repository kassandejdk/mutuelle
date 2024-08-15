<x-dashbord.dashbord_body >
    <link rel="stylesheet" href="{{ asset('admin/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
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
          <p>
            
          </p>
          <h4 class="mb-3 mb-md-0">Liste des membres du mutuelle</h4>
        </div>
  
        <div class="col-md-12 grid-margin stretch-card mt-3">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title">LISTE COMPLETE</h6>
              <div class="table-responsive">
                <table id="dataTableExample" class="table">
                  <thead>
                    <tr>
                      <th>Matricule</th>
                      <th>Nom-Prenom </th>
                      <th>Email</th>
                      <th>Telephone</th>
                      <th>Actions</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                     
                    @foreach ($users as $user )
                    <tr>
                      <td>{{ $user->matricule }}</td>
                      <td>{{ $user->nom }} {{ $user->prenom }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->telephone }}</td>
                      <td>
                        <button type="button" class="btn btn-warning btnPad " data-toggle="modal" data-target="#editModal{{ $user->id }}">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button type="button" class="btn btn-danger btnPad" data-toggle="modal" data-target="#deleteModal{{ $user->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                        
                        <a href="{{ route('voir.plus.membre',$user->id) }}" class="btn btn-info btnPad" >
                          <i class="bi bi-three-dots"></i>
                        </a>
                      </td>
                    </tr>

                   
                    <!-- Modal de modification d'un membre -->
                    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="voirplusLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="voirplusLabel">Details</h5>
                            <button type="button" class="close btn-noboot" data-dismiss="modal" aria-label="Close" style="scale: 1.5">
                              <span aria-hidden="true" style="scale:2">&times;</span>
                            </button>
                          </div>
                          <form action="{{ route('edit.user', $user->id) }}" method="POST">
                              @csrf
                              <div class="modal-body">
                                  <div class="form-group">
                                      <label for="recipient-name" class="col-form-label">Matricule</label>
                                      <input type="text" class="form-control" name="matricule" id="emailDetail" value="{{ $user->matricule }}" disabled>
                                  </div>
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="form-group">
                                      <label for="recipient-name" class="col-form-label">Nom de famille</label>
                                      <input type="text" class="form-control" id="nameFamille" name="nom" value="{{ $user->nom }}">
                                    </div>
                                    <div class="form-group">
                                      <label for="recipient-name" class="col-form-label">Prenom</label>
                                      <input type="text" class="form-control" id="prenom" name="prenom" value="{{ $user->prenom }}">
                                    </div>
                                  </div>
                                </div>
                                
                                
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Email</label>
                                  <input type="text" class="form-control" id="emailDetail" name="email" value="{{ $user->email }}">
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Telephone</label>
                                  <input type="text" class="form-control" id="phoneDetail" name="telephone" value="{{ $user->telephone }}">
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Statut</label>
                                  <input type="text" class="form-control" id="phoneDetail" value="{{ $user->roles->pluck('libelle')->implode(', ') }}" disabled>
                                </div>
                                
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-success" >Modifier</button>
                              </div>

                          </form>
                        </div>
                      </div>
                    </div>
  
                    <!-- modal pour supprimer un utilisateur -->
                    <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="declinerModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="declinerModalLabel">Confirmation</h5>
                            <button type="button" class="close btn-noboot" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" style="scale:2">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p style="font-size: 18px;">
                              Êtes-vous sûr de vouloir supprimer le compte de cet utilisateur ? Cette action est irréversible.
                            </p>
                          </div>
                          <div class="modal-footer">
                            <form id="deleteUserForm{{ $user->id }}" action="{{ route('delete.user',$user->id ) }}" method="POST" >
                              @csrf
                              @method('DELETE')
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                              <button type="submit" class="btn btn-danger" >Confirmer</button>
                            </form>
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
  
  