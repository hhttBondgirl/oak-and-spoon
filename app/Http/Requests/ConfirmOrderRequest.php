<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ConfirmOrderRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'quantities' => ['required', 'array'],
        ];

        foreach (array_keys(config('cafe_menu.items')) as $slug) {
            $rules['quantities.'.$slug] = ['nullable', 'integer', 'min:0', 'max:99'];
        }

        return $rules;
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $menuSlugs = array_keys(config('cafe_menu.items'));
        $incoming = $this->input('quantities', []);
        $normalized = [];

        foreach ($menuSlugs as $slug) {
            $raw = $incoming[$slug] ?? 0;
            if ($raw === '' || $raw === null) {
                $normalized[$slug] = 0;
            } else {
                $normalized[$slug] = $raw;
            }
        }

        $this->merge([
            'quantities' => $normalized,
        ]);
    }
}
