<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Auth;

class OauthRequest extends ApiRequest
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
    public function apiRules() : array
    {
        return [
            'grand_type' => 'required|in:client_credentials,refresh',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно к заполнению!',
        ];
    }
}
