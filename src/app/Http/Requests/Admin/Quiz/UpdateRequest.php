<?php

namespace App\Http\Requests\Admin\Quiz;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'type' => ['string', 'required'],
            'questions' => ['array', 'required', 'min:1'],
            'questions.*.id' => ['required', 'string'],
            'questions.*.body' => ['required', 'string'],
            'questions.*.answerType' => ['required', 'string'],
            'questions.*.answers' => ['nullable', 'array'],
            'questions.*.correctAnswers' => ['required', 'array'],
            'questions.*.maxPoints' => ['required', 'integer', 'min:1'],
            'questions.*.allowPartiallyCorrectAnswers' => ['boolean'],
            'questions.*.requireAscendingOrder' => ['boolean'],
        ];
    }
}
