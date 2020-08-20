<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
            'id_user'    => 'required|numeric',
            'id_service' => 'required|numeric', 
            'nama_paket' => 'required|max:255', 
            'tipe_berat' => 'required|max:3', 
            'harga'      => 'required|numeric'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    public function prepareForValidation()
    {
        $this->merge([
            'id_user' => \Auth::guard('api')->user()->id,
        ]);
    }
}
