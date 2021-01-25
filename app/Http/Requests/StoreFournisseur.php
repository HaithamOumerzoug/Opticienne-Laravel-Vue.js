<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFournisseur extends FormRequest
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
            'nom' => 'required|string|max:255',
            'adresse' => 'required|string|',
            'pays' => 'required|alpha|max:255',
            'ville' => 'required|alpha|max:255',
            'codepostale' => 'required|digits:5|integer',
            'telephone' => 'required|numeric|min:10'
        ];
    }
}
