<x-dashbord.connexion_body>
    
    <div class="col-md-8  ps-md-0">
                    <div class="auth-form-wrapper px-4 py-5">
                        <x-session key='error' type='danger'></x-session>
                        <a href="#" class="noble-ui-logo logo-light d-block mb-2">Gest<span>Mutuelle,</span></a>
                        <h5 class="text-muted fw-normal mb-4">Pour une gestion éfficace de votre mutuelle</h5>
                        <form class="forms-sample" method="POST" action="{{ route('login') }}" >
                            @csrf
                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Matricule </label>
                            <input type="text" class="form-control" id="userEmail" placeholder="Matricule" name="matricule">
                            @error('matricule')
                                <label class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="userPassword" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="userPassword" autocomplete="current-password" name="password" placeholder="Password">
                           
                        </div>
                        <div class="mb-3">
                            <label for="userPassword" class="form-label">Se connecter en tant que</label>
                            <select name="role" id="" class="form-select">
                                <option value="2">Membre</option>
                                <option value="3">Operateur</option>
                            </select>
                            {{-- <input type="password" class="form-control" id="userPassword" autocomplete="current-password" name="password" placeholder="Password"> --}}
                        </div>
                           
                        <div class="form-check mb-3 mt-3">
                            <input type="checkbox" class="form-check-input" id="authCheck">
                            <label class="form-check-label" for="authCheck">
                            Se souvenir de moi
                            </label>
                        </div>
                        <div>
                            <!-- <a href="#" class="btn btn-primary me-2 mb-2 mb-md-0 text-white">Login</a> -->
                            <button type="submit" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
                            Se connecter
                            </button>
                        </div>
                        <a href="{{ route('dashbord.inscription') }}" class="d-block mt-3 text-muted">Pas de compte ? <span class="text-primary">S'inscrire</span></a>
                        </form>
                    </div>
    </div>
</x-dashbord.connexion_body>