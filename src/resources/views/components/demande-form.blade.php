@props([
    'demande' => new App\Models\User(),
])

<div class="row mb-3">
    <label for="motif" class="col-sm-3 col-form-label">Motif</label>
    <div class="col-sm-9">
        <input type="text" class="form-control fs-4 @error('motif') is-invalid @enderror" id="motif"
            placeholder="lancer mon start up" name="motif" value="{{ old('motif', $demande->motif) }}">
        @error('motif')
            <label class="text-danger">{{ $message }}</label>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <label for="montant" class="col-sm-3 col-form-label">montant</label>
    <div class="col-sm-9">
        <input type="number" class="form-control fs-4 @error('montant') is-invalid @enderror" id="montant"
            placeholder="10000" name="montant" value="{{ old('montant', $demande->montant) }}">
        @error('montant')
            <label class="text-danger">{{ $message }}</label>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <label for="description" class="col-sm-3 col-form-label">description</label>
    <div class="col-sm-9">
        <textarea class="form-control fs-4 @error('description') is-invalid @enderror" id="description"
            placeholder="je compte sur cet pret pour demarrer mon start up" name="description" rows="4">{{ old('description', $demande->description) }}</textarea>
        @error('description')
            <label class="text-danger">{{ $message }}</label>
        @enderror
    </div>
</div>
@if ($demande->id && !$demande->justificatifs?->isEmpty())
    <div class="row my-3">
        <h3>Les documents joints</h3>
        @foreach ($demande->id?$demande->justificatifs:[] as $fichier)
            <div class="card my-2 p-2 col-md-5  mx-md-2" id="fic-{{ $fichier->id }}">
                <div class="row">
                    <div class="col-8">
                        <p class="fs-5 fs-md-3">
                            <i data-feather="file"></i> {{ $fichier->libelle }}
                        </p>
                    </div>
                    <div class="col-4 ">
                        <a href="{{ $fichier->getUrl() }}" target="_blank" class="text-info me-2"><i
                                data-feather="eye"></i></a>
                        <a href="{{ route('membre.justificatif.destroy', $fichier) }}" class="text-danger"><i
                                data-feather="trash"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
<div class="mb-3">
    <h3>Voulez vous joindre des justificatifs?</h3>
    @error('justificatifs.*')
        <label class="text-danger">{{ $message }}</label>
    @enderror
    @error('justificatifs')
        <label class="text-danger">{{ $message }}</label>
    @enderror
    <div class="justificatif" id="options-container{{ $demande->id?:'' }}"></div>
    <span class="" id="add-option-btn{{ $demande->id?:'' }}">
        <i class="text-success mt-2 ms-2 fs-3 me-2" style="cursor: pointer" data-feather="plus-circle"></i>
    </span>
    <span class="" id="remove-option-btn{{ $demande->id?:'' }}">
        <i class="text-danger mt-2 ms-2 fs-3" style="cursor: pointer" data-feather="minus-circle"></i>
    </span>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        function addOption(opt = "") {
            optionCount{{ $demande->id?:'' }}++;
            const newOption = document.createElement('div');
            newOption.classList.add(`option-field${optionCount{{ $demande->id?:'' }}}`, 'card', 'my-2', 'p-3');
            newOption.innerHTML = `
            <h3 for="option${optionCount{{ $demande->id?:'' }}}" class="my-2">Justificatif N ${optionCount{{ $demande->id?:'' }}}</h3>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">titre du document</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control fs-4" name="justificatifs[${optionCount{{ $demande->id?:'' }}}][label]" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">fichier(.img,pdf)</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control fs-4" name="justificatifs[${optionCount{{ $demande->id?:'' }}}][file]" required>
                </div>
            </div>

        `;
            optionsContainer.appendChild(newOption);
        }
        const optionsContainer = document.getElementById('options-container{{ $demande->id?:'' }}');
        const addOptionBtn = document.getElementById('add-option-btn{{ $demande->id?:'' }}');
        console.log(addOptionBtn);
        const removeOptionBtn = document.getElementById('remove-option-btn{{ $demande->id?:'' }}');
        let optionCount{{ $demande->id?:'' }} = {{ $demande->id?$demande->justificatifs->count():0 }};
        console.log(optionCount{{ $demande->id?:'' }});
        if (optionCount{{ $demande->id?:'' }} >= 3) addOptionBtn.classList.add('d-none');
        else if (optionCount{{ $demande->id?:'' }} <= 0) removeOptionBtn.classList.add('d-none');
        addOptionBtn.addEventListener('click', () => {
            console.log('click');
            if (optionCount{{ $demande->id?:'' }} < 4) {
                addOption();
                removeOptionBtn.classList.remove('d-none');
            }
            if (optionCount{{ $demande->id?:'' }} >= 4) addOptionBtn.classList.add('d-none');
        });
        removeOptionBtn.addEventListener('click', () => {
            if (optionCount{{ $demande->id?:'' }} > 0) {
                const Option = document.querySelector(`.option-field${optionCount{{ $demande->id?:'' }}}`);
                if (Option?.parentElement.removeChild(Option)) {
                    optionCount{{ $demande->id?:'' }}--;
                    addOptionBtn.classList.remove('d-none');
                }

            }
            if (optionCount{{ $demande->id?:'' }} <= 0) removeOptionBtn.classList.add('d-none');
        });
    });
</script>
