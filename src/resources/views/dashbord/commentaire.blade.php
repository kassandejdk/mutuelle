
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
          <h4 class="mb-3 mb-md-0">Liste des membres commentaires </h4>
        </div>
  
        <div class="col-md-12 grid-margin stretch-card mt-3">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title">LISTE COMPLETE</h6>
              <div class="table-responsive">
                <table id="dataTableExample" class="table">
                  <thead>
                    <tr>
                      <th>Email</th>
                      <th>Sujet</th>
                      <th>Message</th>
                      <th>Actions</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                     
                    @foreach ($contacts as $key => $contact )
                    <tr>
                      <td>{{ $contact->email }} </td>
                      <td>{{ $contact->sujet }}</td>
                      <td>{{ $contact->message }}</td>
                      <td>
                        <button type="button" class="btn btn-danger btnPad " data-toggle="modal" data-target="#deleteContact{{ $contact->id }}">
                            <i class="bi bi-trash"></i>
                        </button>
                       
                      </td>
                      
                    </tr>
                    
                    <!-- Modal de confirmation de suppresion d'un commentaire-->
                    <div class="modal fade" id="deleteContact{{ $contact->id }}" tabindex="-1" role="dialog" aria-labelledby="voirplusLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog modal-lg" role="document">
                          <div class="modal-content fs-5">
                            <div class="modal-header">
                              <h5 class="modal-title" id="voirplusLabel">Confirmation</h5>
                              <button type="button" class="close btn-noboot" data-dismiss="modal" aria-label="Close" style="scale: 1.5">
                                <span aria-hidden="true" style="scale:2">&times;</span>
                              </button>
                            </div>
                            <form action="{{ route('delete.commentaire', $contact->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-body ">
                                    Êtes-vous sûr de vouloir supprimer ce commentaire ? Cette action est irréversible
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-toggle="modal" data-dismiss="modal">Annuler</button>
                                  <button type="submit" class="btn btn-danger">Supprimer</button>
                                </div>
                            </form>
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
  
  