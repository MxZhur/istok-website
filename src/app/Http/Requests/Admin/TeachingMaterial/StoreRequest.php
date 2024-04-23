<?php

namespace App\Http\Requests\Admin\TeachingMaterial;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('web')->check() && auth('web')->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['string', 'required'],
            'body' => ['string', 'nullable'],
            'type' => ['string', 'required'],
            'tags' => ['array', 'nullable'],
            'newFiles' => ['array', 'nullable'],
            'newFiles.*' => ['file'],
        ];
    }
}
