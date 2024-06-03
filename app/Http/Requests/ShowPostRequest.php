<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ShowPostRequest',
    title: 'ShowPostRequest',
    description: 'Post show request',
    properties: [
        new OA\Property(property: 'user_id', type: 'int', example: 1),
        new OA\Property(property: 'post', type: 'string', maximum: 65535, example: 'Some text'),
    ],
)]
class ShowPostRequest extends FormRequest
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
            'id' => ['required', 'integer', 'exists:posts,id']
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('post'),
        ]);
    }
}
