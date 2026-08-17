<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
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
        ];
    }
}
