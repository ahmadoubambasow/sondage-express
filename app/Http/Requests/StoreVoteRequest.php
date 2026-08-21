<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVoteRequest extends FormRequest
{
    /**
     * Tout visiteur peut voter.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'poll_option_id' => [
                'required',
                'integer',
                'exists:poll_options,id',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'poll_option_id.required' =>
                'Veuillez sélectionner une option.',

            'poll_option_id.exists' =>
                'L’option sélectionnée est invalide.',
            
            'poll_option_id.integer' =>
                'L’option sélectionnée est invalide.',
        ];
    }
}
