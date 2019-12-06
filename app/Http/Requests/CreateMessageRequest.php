<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Auth;

class CreateMessageRequest extends ApiRequest
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
            'to' => 'required|max:255|exists:users,username|not_in:' . Auth::user()->getLogin(),
            'message' => 'string|max:' . config('request.message-length-limit'),
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
            'email' => 'Указан невалидый email!',
            'max' => 'Превышен лимит длинны значения поля!',
            'not_in' => 'Отправлять сообщение самому себе довольно странно :)'
        ];
    }

    /**
     * @return User
     */
    public function getSender()
    {
        return Auth::user();
    }

    /**
     * @return User
     */
    public function getReceiver()
    {
        return User::query()->where('username', $this->input('to'))->first();
    }

    /**
     * @return array|null|string
     */
    public function getMessage()
    {
        return $this->input('message');
    }

    /**
     * @return array|null|string
     */
    public function withEmail()
    {
        return $this->input('email', false);
    }
}
