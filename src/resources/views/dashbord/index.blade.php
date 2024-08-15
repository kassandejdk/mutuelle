
<x-dashbord.dashbord_body >
  <link rel="stylesheet" href="{{ asset('admin/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script> --}}
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}

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
        <h4 class="mb-3 mb-md-0">Liste des demandes d'inscriptions</h4>
      </div>

      <div class="col-md-12 grid-margin stretch-card mt-3">
        <div class="card">
          <div class="card-body">
            <h6 class="card-title">LISTE COMPLETE</h6>
            <div class="table-responsive">
              <table id="dataTableExample" class="table">
                <thead>
                  <tr>
                    <th>Nom </th>
                    <th>Prenom</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Actions</th>
                    
                  </tr>
                </thead>
                <tbody>
                   
                  @foreach ($demandeInscriptions as $user )
                  <tr>
                    <td>{{ $user->nom }}</td>
                    <td>{{ $user->prenom }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telephone }}</td>
                    <td>
                      <button type="button" class="btn-noboot " data-toggle="modal" data-target="#voirplus{{ $user->id }}">
                        <i class="bi bi-three-dots"></i>
                      </button>
                    </td>
                    <!-- Modal de detail d'un membre -->
                    <div class="modal fade" id="voirplus{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="voirplusLabel" aria-hidden="true">
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
                                  <input type="text" class="form-control" id="nameFamille" value="{{ $user->nom }}">
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Prenom</label>
                                  <input type="text" class="form-control" id="prenom" value="{{ $user->prenom }}">
                                </div>
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Email</label>
                              <input type="text" class="form-control" id="emailDetail" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Telephone</label>
                              <input type="text" class="form-control" id="phoneDetail" value="{{ $user->telephone }}">
                            </div>
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">CNIB ou document equivalent</label>
                              <div id="pdfContainer{{ $user->id }}" class="pdf-container">
                                  <embed class="pdf-embed" src="{{ asset('storage/' . $user->cnib) }}" type="application/pdf" width="100%" height="600px" />
                                  <p class="pdf-download-link">
                                    <a class="btn btn-primary" href="{{ asset('storage/' . $user->cnib) }}" target="_blank" ><i class="bi bi-download"></i></a>
                                  </p>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#declinerModal{{ $user->id }}">Decliner</button>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#raisonModal{{ $user->id }}">Renvoyer</button>
                            <a href="{{ route('envoyer.matricule', $user->id) }}" class="btn btn-success" style="color:#000; text-decoration:none;">Accepter</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </tr>

                  <!-- modal pour bannir un utilisateur -->
                  <div class="modal fade" id="declinerModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="declinerModalLabel" aria-hidden="true">
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
                            Êtes-vous sûr de vouloir desactiver le compte de cet utilisateur ? Cette action est irréversible.
                            <br>
                            NB:L'utilisateur ne sera plus autorisé à soumettre une demande d'inscription sur votre plateforme !!!
                          </p>
                        </div>
                        <div class="modal-footer">
                          <form id="deleteUserForm{{ $user->id }}" action="{{ route('bannir.user',$user->id ) }}" method="POST" >
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-danger" >Confirmer</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Modal pour saisir la raison du renvoi -->
                  <div class="modal fade" id="raisonModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="raisonModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="raisonModalLabel">Raison du renvoi</h5>
                          <button type="button" class="close btn-noboot" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="scale:2">&times;</span>
                          </button>

                        </div>
                        <div class="modal-body">
                          <p style="font-style: italic;">Le destinataire: <a href="mailto:{{ $user->email }}" style="color: #48ff00">{{ $user->email }}</a></p>
                          <form id="raisonForm{{ $user->id }}" action="{{ route('envoyer.email',$user->id) }}" method="POST">
                            @csrf
                            <div class="form-group mt-2">
                              <label for="raison">Préciser le motif pour guider l'adherant pour la reprise</label>
                              <textarea class="form-control mt-2" id="raison" name="raison" rows="3" required></textarea>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                              <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>
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

