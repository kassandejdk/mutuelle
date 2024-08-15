<x-dashbord.connexion_body>

    <div class="col-md-8 ps-md-0">
        <div class="auth-form-wrapper px-4 py-5">
            <a href="#" class="noble-ui-logo logo-light d-block mb-2">Gest<span>Mutuelle</span></a>
            <h5 class="text-muted fw-normal mb-4"> CREATION D'UN COMPTE </h5>
            <form class="forms-sample" enctype="multipart/form-data" method="POST" action="{{ route('register') }}" >
                @csrf
            <div class="mb-3">
                {{-- <label for="userName" class="form-label">Nom de famille</label> --}}
                <input type="text" class="form-control" id="userName" name="nom" autocomplete="username" value="{{ old('nom') }}" placeholder="Nom de famille">
                @error('nom')
                    <label class="text-danger">{{ $message }}</label>
                @enderror
            </div>
            <div class="mb-3">
                {{-- <label for="userPrenom" class="form-label">Prenom </label> --}}
                <input type="text" class="form-control" id="userPrenom" name="prenom" value="{{ old('prenom') }}" autocomplete="username" placeholder="Prenom">
                @error('prenom')
                    <label class="text-danger">{{ $message }}</label>
                @enderror
            </div>
            <div class="mb-3">
                {{-- <label for="userEmail" class="form-label">Email</label> --}}
                <input type="email" class="form-control" id="userEmail" name="email" value="{{ old('email') }}" placeholder="Email">
                @error('email')
                    <label class="text-danger">{{ $message }}</label>
                @enderror
            </div>
            <div class="mb-3">
                {{-- <label for="userPhone" class="form-label">Téléphone</label> --}}
                <input type="number" class="form-control" id="userPhone" name="telephone" value="{{ old('telephone') }}" placeholder="74415998">
                @error('telephone')
                    <label class="text-danger">{{ $message }}</label>
                @enderror
            </div>
            <div class="mb-3">
                {{-- <label for="userCnib" class="form-label">Votre CNIB(autre document équivalent) <i>au format PDF</i></label> --}}
                <input type="file" class="form-control" id="userCnib" name="cnib" accept=".pdf" >  
                @error('cnib')
                    <label class="text-danger">{{ $message }}</label>
                @enderror
            </div>
            <div class="mb-3">
                {{-- <label for="userPassword" class="form-label">Mot de passe</label> --}}
                <input type="password" class="form-control" id="userPassword" name="password" autocomplete="current-password" placeholder="Mot de passe">
            </div>
            <div class="mb-3">
                {{-- <label for="userConf" class="form-label">Confirmation de mot de passe</label> --}}
                <input type="password" class="form-control" id="userConf" name="password_confirmation" autocomplete="current-password" placeholder="Confirmation">
            </div>
            
            <div>
                <!-- <a href="../../dashboard.html" class="btn btn-primary text-white me-2 mb-2 mb-md-0">Sign up</a> -->
                <button type="submit" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                <!-- <i class="btn-icon-prepend" data-feather="twitter"></i> -->
                S'inscrire
                </button>
            </div>
            <a href="{{ route('dashbord.accueil') }}" class="d-block mt-3 text-muted">Vous avez déjà un compte ? <span class="text-primary">Se connecter</span></a>
            </>
        </div>
    </div>
</x-dashbord.connexion_body>