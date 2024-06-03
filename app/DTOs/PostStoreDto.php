<?php

namespace App\DTOs;

use App\Http\Requests\StorePostRequest;

class PostStoreDto
{

    public function __construct(
        private int $user_id,
        private string $post
    ) {
    }

    public static function fromRequest(StorePostRequest $request): static
    {
        return new static(
            user_id: $request->user_id,
            post: $request->post
        );
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @return string
     */
    public function getPost(): string
    {
        return $this->post;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
