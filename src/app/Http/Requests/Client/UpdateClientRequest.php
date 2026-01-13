<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
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
        $id = $this->route('client');
        return [
            //
            'company' => ['required', 'string', 'max:155'],
            'firstName' => ['nullable', 'string', 'max:155'],
            'lastName' => ['nullable', 'string', 'max:155'],
            'email' => [
                'nullable',
                'string',
                'email',
                Rule::unique('clients', 'email')->ignore($id, 'id')
            ],
            'contact' => ['nullable', 'string', 'max:15'],
            'address' => ['required', 'string', 'max:255'],
        ];
    }
}
