<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class ApiRequest extends FormRequest
{
    /**
     * Get the api validation rules.
     *
     * @return array
     */
    abstract public function apiRules() : array;
}
