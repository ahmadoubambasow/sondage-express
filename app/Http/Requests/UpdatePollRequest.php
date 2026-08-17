<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePollRequest extends FormRequest
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
            'title' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'options' => [
                'required',
                'array',
                'min:2',
            ],

            'options.*' => [
                'required',
                'string',
                'min:1',
                'max:255',
                'distinct',
            ],

            'status' => [
                'required',
                Rule::in(['draft', 'active', 'closed']),
            ],

            'expires_at' => [
                'nullable',
                'date',
                'after:now',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Le titre du sondage est obligatoire.',
            'title.min' => 'Le titre doit contenir au moins :min caractères.',
            'options.required' => 'Vous devez ajouter des options.',
            'options.min' => 'Un sondage doit avoir au moins deux options.',
            'options.*.required' => 'Chaque option est obligatoire.',
            'options.*.distinct' => 'Les options doivent être différentes.',
            'expires_at.after' => 'La date doit être dans le futur.',
        ];
    }
}
