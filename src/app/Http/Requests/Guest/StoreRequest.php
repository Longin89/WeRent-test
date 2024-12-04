<?php

namespace App\Http\Requests\Guest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    //  Правила для записи в базу (согласно ТЗ), а так-же regexp для определения формата номера телефона

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:155',
            'last_name' => 'required|string|max:155',
            'phone' => [
                'required',
                'string',
                'regex:/^([+\d]{1,4})[-\s]?[\d\s()-]{8,20}$/',
                Rule::unique('guests')->where(function ($exist) {
                    return $exist->where('phone', $this->input('phone'));
                }),
            ],
            'email' => 'nullable|email|unique:guests|max:155',
            'country' => 'string|max:155',
        ];
    }
}
