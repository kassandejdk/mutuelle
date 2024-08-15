<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DemandeFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'motif'=>['required','string','max:255'],
            'description'=>[''],
            'montant'=>['required','numeric','min:0'],
            'justificatifs'=>['array'],
            'justificatifs.*.label'=>['required','string','max:255'],
            'justificatifs.*.file'=>['required','file','mimetypes:application/pdf,image/jpeg,image/png,image/jpg','max:2048'],
            'user_id'=>['required','integer','exists:users,id'],
            'statut'=>['required','string']
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'user_id'=>$this->user()?->id,
            'statut'=>'en traitement'
        ]);
    }

}
