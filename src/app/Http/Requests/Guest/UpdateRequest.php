<?php

namespace App\Http\Requests\Guest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    //  Правила для обновления в базе, а так-же regexp для определения формата номера телефона

    public function rules(): array
    {
        return [
            'first_name' => 'string|max:155',
            'last_name' => 'string|max:155',
            'phone' => [
                'string',
                'regex:/^([+\d]{1,4})[-\s]?[\d\s()-]{8,20}$/',
                Rule::unique('guests', 'phone')->ignore($this->route('guest')),
            ],
            'email' => 'unique:guests,email|max:155',
            'country' => 'nullable|string|max:155',
        ];
    }
}
