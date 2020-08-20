<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpanseRequest extends FormRequest
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
            'id_user' => 'required|numeric',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'catatan' => 'max:255'
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
