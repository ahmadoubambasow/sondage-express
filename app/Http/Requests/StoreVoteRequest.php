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
     * Règles de validation.
     */
    public function rules(): array
    {
        return [
            'poll_option_ids' => [
                'required',
                'array',
                'min:1',
            ],

            'poll_option_ids.*' => [
                'required',
                'integer',
                'exists:poll_options,id',
            ],
        ];
    }

    /**
     * Messages personnalisés.
     */
    public function messages(): array
    {
        return [
            'poll_option_ids.required' =>
                'Veuillez sélectionner au moins une option.',

            'poll_option_ids.array' =>
                'Les options sélectionnées sont invalides.',

            'poll_option_ids.min' =>
                'Veuillez sélectionner au moins une option.',

            'poll_option_ids.*.required' =>
                'Une option est invalide.',

            'poll_option_ids.*.integer' =>
                'Une option sélectionnée est invalide.',

            'poll_option_ids.*.exists' =>
                'Une option sélectionnée est invalide.',
        ];
    }
}