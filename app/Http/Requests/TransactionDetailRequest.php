<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionDetailRequest extends FormRequest
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
            'id_transaction' => 'required|numeric',
            'id_package' => 'required|numeric',
            'qty' => 'required|numeric',
            'harga' => 'required|numeric',
            'status' => 'required'
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    public function prepareForValidation()
    {
        // IF EMPTY ID (STORE)
        if(!$this->request->get('id')){
            $merg['status'] = 'diterima';
        }
        
        $this->merge($merg);
    }
}
