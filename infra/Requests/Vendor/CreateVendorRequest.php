<?php

namespace Infra\Requests\Vendor;

use Infra\Requests\ApiRequest;

class CreateVendorRequest extends ApiRequest
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
            //
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:vendors'],
            'contact' => ['required', 'string'],
            'address' => ['required', 'string'],
        ];
    }
}
