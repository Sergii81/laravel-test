<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'StorePostRequest',
    title: 'StorePostRequest',
    description: 'Post store request',
    properties: [
        new OA\Property(property: 'user_id', type: 'int', example: 1),
        new OA\Property(property: 'post', type: 'string', maximum: 65535, example: 'Some text'),
    ],
)]
class StorePostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'post' => ['required', 'string', 'max:65535']
        ];
    }
}
