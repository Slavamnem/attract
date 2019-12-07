<?php

namespace App\Http\Requests;

class RegistrationRequest extends ApiRequest
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
            'username' => 'required|max:50|unique:users,username',
            'email'    => 'email|required|max:255|unique:users,email',
            'password' => 'required|max:50',
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
        ];
    }

    /**
     * @return array|null|string
     */
    public function getUsername()
    {
        return $this->input('username');
    }

    /**
     * @return array|null|string
     */
    public function getEmail()
    {
        return $this->input('email');
    }

    /**
     * @return array|null|string
     */
    public function getPassword()
    {
        return $this->input('password');
    }
}
