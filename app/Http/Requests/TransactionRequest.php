<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'id_customer' => 'required|numeric',
            'id_user' => 'required|numeric',
            'code' => 'required',
            'total_harga' => 'required',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    public function prepareForValidation()
    {
        $apiUserId = \Auth::guard('api')->user()->id ?? '';
        
        if($apiUserId){
            $merg['id_user'] = $apiUserId;
        }else{
            $merg['id_user'] = \Auth::user()->id;
        }

        // IF EMPTY ID (STORE)
        if(!$this->request->get('id')){
            $merg['total_harga'] = 0;
        }
        
        $this->merge($merg);
    }
}
