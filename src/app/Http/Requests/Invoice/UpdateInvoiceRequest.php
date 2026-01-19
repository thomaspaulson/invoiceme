<?php

namespace App\Http\Requests\Invoice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateInvoiceRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            //
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'gstin' => [
                'required',
                'string',
                // 'size:15',
                // 'regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/',
            ],
            'taxes' => ['required', 'array'],
            'taxes.*' => ['required', 'string', 'in:cgst,sgst,igst', 'distinct'],
            ...$this->getItemsRule(),
        ];
    }

    public function getItemsRule(){
        return [
            'items' => ['required', 'array', 'min:1'],

            'items.*.id' => [
                'required',
                'string',
                // 'exists:items,id',
                // 'distinct',
            ],

            'items.*.name' => [
                'required',
                'string',
                'max:255',
            ],

            'items.*.hsn_code' => [
                'required',
                'string',
                'in:' . implode(',', array_keys(config('tax.hsncodes')))
                // 'regex:/^[0-9]{4,8}$/',
            ],

            'items.*.rate' => [
                'required',
                'numeric',
                'min:0',
            ],

            'items.*.quantity' => [
                'required',
                'integer',
                'min:1',
            ],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $taxes = $this->input('taxes', []);

            if (! in_array('cgst', $taxes)) {
                $validator->errors()->add('taxes', 'CGST is required.');
            }

            if (! in_array('sgst', $taxes) && ! in_array('igst', $taxes)) {
                $validator->errors()->add('taxes', 'Either SGST or IGST is required.');
            }
        });
    }
}
