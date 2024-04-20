<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('web')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'entity_type' => ['required', 'string'],
            'entity_id' => ['required', 'integer'],
            'parent_id' => ['integer', 'nullable'],
            'user_id' => ['required', 'integer'],
            'text' => ['required', 'string'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth('web')->id(),
            'text' => trim($this->text),
        ]);
    }
}
