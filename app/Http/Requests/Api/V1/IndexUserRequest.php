<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class IndexUserRequest extends FormRequest
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
        return [
            'limit' => ['numeric', 'integer', 'min:1'],
            'offset' => ['numeric', 'integer', 'min:1'],
            'user_id' => ['numeric', 'integer', 'min:1', 'exists:users,id'],
            'rubric_id' => ['numeric', 'integer', 'min:1', 'exists:rubrics,id'],
        ];
    }
}
