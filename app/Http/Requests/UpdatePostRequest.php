<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'UpdatePostRequest',
    title: 'UpdatePostRequest',
    description: 'Post update request',
    properties: [
        new OA\Property(property: 'post', type: 'string', maximum: 65535, example: 'Some text'),
    ],
)]
class UpdatePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer', 'exists:posts,id'],
            'post' => ['required', 'string', 'max:65535']
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('post'),
        ]);
    }
}
