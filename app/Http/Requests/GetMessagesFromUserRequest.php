<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Auth;

class GetMessagesFromUserRequest extends ApiRequest
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
            'sender' => 'required|exists:users,username',
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
            'exists' => 'Отправитель не найден!',
        ];
    }

    /**
     * @return User
     */
    public function getSender()
    {
        return User::query()->where('username', $this->input('sender'))->first();
    }

    /**
     * @return User
     */
    public function getReceiver()
    {
        return Auth::user();
    }
}
