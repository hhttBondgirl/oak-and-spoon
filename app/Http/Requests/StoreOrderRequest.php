<?php

namespace App\Http\Requests;

use App\Models\Menu;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreOrderRequest extends FormRequest
{
    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'counts' => ['required', 'array', 'min:1'],
            'counts.*' => ['integer', 'min:1', 'max:99'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'counts.required' => '注文内容が不正です。',
            'counts.array' => '注文内容が不正です。',
            'counts.min' => '1品目以上選択してください。',
            'counts.*.integer' => '数量は整数で指定してください。',
            'counts.*.min' => '数量は1以上で指定してください。',
            'counts.*.max' => '数量が大きすぎます。',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            if ($validator->errors()->isNotEmpty()) {
                return;
            }

            $counts = $this->input('counts', []);
            $ids = array_map(intval(...), array_keys($counts));
            $existing = Menu::query()->whereIn('id', $ids)->count();

            if ($existing !== count($ids)) {
                $validator->errors()->add('counts', '無効なメニューが含まれています。');
            }
        });
    }
}
