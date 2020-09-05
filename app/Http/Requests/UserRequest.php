<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UserRequest extends FormRequest
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
        if($id = $this->request->get('id')){

            // UPDATE
            if($this->request->get('password') == null){
                return [
                    'name'  => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users,email,'.$id,
                ];  
            }
            
            return [
                'name'  => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email,'.$id,
                'password' => 'required_with:password_confirmation|same:password_confirmation',
            ];
        }
        
        // STORE
        return [
            'name'  => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|required_with:password_confirmation|same:password_confirmation',
            'role' => 'required|max:255',
            'api_token' => 'required'
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
            'api_token' => Str::random(80),
        ]);
    }
}

