
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
          <h4 class="mb-3 mb-md-0">Liste des demandes de prets </h4>
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
                      <th>Motif</th>
                      <th>Statut</th>
                      <th>Montant</th>
                      <th>Actions</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                     
                    @foreach ($demandes as $key => $demande )
                    <tr>
                      <td>{{ $demande->user->nom }} {{ $demande->user->prenom }}</td>
                      <td>{{ $demande->motif }}</td>
                      <td>{{ $demande->statut }}</td>
                      <td>{{ $demande->montant }}</td>
                      <td>
                        <button type="button" class="btn btn-warning btnPad " data-toggle="modal" data-target="#detailDemande{{ $demande->id }}">
                            <i class="bi bi-three-dots"></i>
                        </button>
                       
                      </td>
                      
                    </tr>
                    
                    <!-- Modal de demande-->
                    <div class="modal fade" id="detailDemande{{ $demande->id }}" tabindex="-1" role="dialog" aria-labelledby="voirplusLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="voirplusLabel">Details du pret</h5>
                              <button type="button" class="close btn-noboot" data-dismiss="modal" aria-label="Close" style="scale: 1.5">
                                <span aria-hidden="true" style="scale:2">&times;</span>
                              </button>
                            </div>
                            <form action="{{ route('edit.user', $demande->id) }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Nom de famille </label>
                                        <input type="text" class="form-control" name="nom" id="emailDetail1" value="{{ $demande->user->nom }}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Prenom </label>
                                        <input type="text" class="form-control" name="prenom" id="emailDetail2" value="{{ $demande->user->prenom }}" >
                                    </div>
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Motif</label>
                                        <input type="text" class="form-control" id="nameFamille" name="motif" value="{{ $demande->motif }}">
                                      </div>
                                      <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Description</label>
                                        <input type="text" class="form-control" id="prenom" name="description" value="{{ $demande->description }}">
                                      </div>
                                    </div>
                                  </div>
                                  
                                  
                                  <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Montant</label>
                                    <input type="text" class="form-control" id="emailDetail" name="montant" value="{{ $demande->montant }}">
                                  </div>
                                  <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Statut</label>
                                    <input type="text" class="form-control" id="phoneDetail" name="statut" value="{{ $demande->statut }}" disabled>
                                  </div>
                                  @if ($demande->justificatifs->isEmpty())
                                  <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Aucun fichier associe !!!</label>
                                  </div>
                                  @else
                                  @foreach ($demande->justificatifs as $justificatif )

                                    <div class="form-group">
                                      <label for="recipient-name" class="col-form-label">Libelle</label>
                                      <input type="text" class="form-control" id="phoneDetail" name="libelle" value="{{ $justificatif->libelle }}" disabled>
                                    </div>
                                    <div class="form-group">
                                      @if(Str::endsWith($justificatif->fichier, ['.jpg', '.jpeg', '.png', '.gif']))
                                          <label for="" class="m-1">Image associe</label>
                                          <div>
                                            <img src="{{ $justificatif->getUrl() }}" alt="Image">
                                          </div>
                                      @elseif(Str::endsWith($justificatif->fichier, '.pdf'))
                                            <div id="pdfContainer{{ $justificatif->id }}" class="pdf-container">
                                            <label for="" class="m-1">Fichier associe</label>
                                              <embed class="pdf-embed" src="{{ $justificatif->getUrl()  }}" type="application/pdf" width="100%" height="600px" />
                                              <p class="pdf-download-link">
                                                <a class="btn btn-primary" href="{{ $justificatif->getUrl() }}" target="_blank" ><i class="bi bi-download"></i></a>
                                              </p>
                                            </div>
                                      @endif
                                    </div>
                                  @endforeach
                                  @endif
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-danger" data-toggle="modal" data-dismiss="modal">Fermer</button>
                                    <a href="{{ route('refuser.demande',$demande->id) }}" class="btn btn-info">Refuser</a>
                                  </button>
                                  <button type="button" class="btn btn-info"  data-toggle="modal" data-target="#accepterModal{{ $demande->id }}" >Accepter</button>
                                </div>
                             </div>
                            </form>
                          </div>
                        </div>
                    </div>
              
                       <!-- Modal d'acceptation--> 

                    <div class="modal fade fs-5" id="accepterModal{{ $demande->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Generation du contrat</h5>
                            <button type="button" class="close btn-noboot" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="{{ route('creer.pret') }}" method="POST">
                              @csrf
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Montant</label>
                                    <input type="number" class="form-control" id="montab" name="montant" value="{{ $demande->montant }}" >
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Taux</label>
                                    <input type="number" class="form-control" id="phoneDetail" min="0" max="100" name="taux" required  >
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Delais de remise</label>
                                <input type="date" class="form-control" id="delaiRemise" min="{{ date('d-m-Y') }}" value="{{ date('d-m-Y')}}" name="delais" >
                              </div>
                              <input type="hidden" name="demande_id" value="{{ $demande->id }}">
                             
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary" >Envoyer</button>
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
  
  