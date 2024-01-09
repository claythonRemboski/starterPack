<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateZipcode extends FormRequest
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
        $rules = [
            'UF' => 'required|in: RJ,SP,ES,MG,PR,SC,RS,MS,GO,AC,AL,AP,AM,BA,CE,DF,MA,MT,PA,PB,PE,PI,RN,RO,RR,SE,TO',
            'CIDADE' => 'required|min:3|max:255',
            'DEPARTAMENTO' => [
                'required',
                'string',
                'max:255',
                "unique:zipcode,DEPARTAMENTO",
            ],
            'CEP_INICIO_1' => [
                'required',
                'integer',
                "unique:zipcode,CEP_INICIO_1",
            ],
            'CEP_INICIO_2' => 'required|integer',
            'CEP_FIM_1' => [
                'required',
                'integer',
                "unique:zipcode,CEP_FIM_1",
            ],
            'CEP_FIM_2' => 'nullable|integer',
        ];

        if ($this->method() === 'PATCH') {
            $rules = [
                'UF' => 'required|in: RJ,SP,ES,MG,PR,SC,RS,MS,GO,AC,AL,AP,AM,BA,CE,DF,MA,MT,PA,PB,PE,PI,RN,RO,RR,SE,TO',
                'CIDADE' => 'required|min:3|max:255',
                'DEPARTAMENTO' => [
                    'required',
                    'string',
                    'max:255',
                    "unique:zipcode,DEPARTAMENTO",
                    Rule::unique('zipcode')->ignore($this->id)
                ],
                'CEP_INICIO_1' => [
                    'required',
                    'integer',
                    "unique:zipcode,CEP_INICIO_1",
                    Rule::unique('zipcode')->ignore($this->id)
                ],
                'CEP_INICIO_2' => 'required|integer',
                'CEP_FIM_1' => [
                    'required',
                    'integer',
                    "unique:zipcode,CEP_FIM_1",
                    Rule::unique('zipcode')->ignore($this->id)
                ],
                'CEP_FIM_2' => 'nullable|integer',
            ];
        }

        return $rules;
    }
}
