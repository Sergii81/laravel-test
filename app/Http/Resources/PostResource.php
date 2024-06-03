<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'PostResource',
    title: 'PostResource',
    description: 'Post Resource',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'post', type: 'string', example: 'Some text'),
        new OA\Property(property: 'created_at', type: 'string', example: '2024:06:03'),
        new OA\Property(property: 'user', ref: '#/components/schemas/UserResource'),
    ],
)]
class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => UserResource::make($this->user),
            'post' => $this->post,
            'created_at' => $this->created_at,
        ];
    }
}
