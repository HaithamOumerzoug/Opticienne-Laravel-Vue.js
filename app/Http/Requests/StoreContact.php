<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContact extends FormRequest
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
     * @return  
     */
    public function rules()
    {
        return [
            'nom' => 'required|min:3',
            'prenom' => 'required|min:3',
            'email' => 'required',
            'message' => 'required'
    ];
    }
}
