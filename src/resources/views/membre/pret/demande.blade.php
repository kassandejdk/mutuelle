<x-dashbord.dashbord_body :membre="true">
    <x-session key="success" :time="5000"></x-session>
    <x-session key="error" type="danger"></x-session>
    <h2>Editer ma demande</h2>
    <div class="modal-content">
        <form action="{{ route('membre.demande.update', $demande) }}" class="forms mt-4" method="POST"
            enctype="multipart/form-data">

            @method('PUT')
            @csrf

            <div class="modal-body">
                
                <div class="card">
                    <div class="card-body">
                        <x-demande-form :demande="$demande"></x-demande-form>
                    </div>
                </div>
            </div>
            <div class="action mt-3">
                <a href="{{ route('membre.home') }}" class="btn btn-secondary" >Retour</a>
                <button type="submit" class="btn btn-primary">Mettre a
                    jour</button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteModal" >Supprimer</button>
            </div>

        </form>
    </div>
    <!--More Modal -->
    <div class="modal fade" id="DeleteModal" tabindex="-1"
        aria-labelledby="DeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('membre.demande.destroy', $demande) }}"
                    class="forms mt-4" method="POST"
                    >
                    
                    @method('DELETE')
                    @csrf
                    <div class="modal-header">
                        
                        <h5 class="modal-title" id="DeleteModalLabel">confirmation de suppression
                        </h5>
                        <button type="button" class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <p class="fs-3">Voulez vous vraiment supprimer cette demande?</p>
                                <p class="text-danger fs-4 mt-3">Cette action est irreversible</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-dashbord.dashbord_body>
