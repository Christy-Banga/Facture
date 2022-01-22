<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFactureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'numero_facture' => 'required',
            'nom_fournisseur' => 'required',
            'date_facturation' => 'required',
            'date_echeance' => 'required',
            'montant_HT' => 'required',
            'montant_TTC' => 'required',
        ];
    }
}
