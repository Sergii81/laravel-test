<?php

namespace App\DTOs;

use App\Http\Requests\UpdatePostRequest;

class PostUpdateDto
{
    /**
     * @param int $id
     * @param string $post
     */
    public function __construct(
        private int $id,
        private string $post
    ) {
    }

    public static function fromRequest(UpdatePostRequest $request): static
    {
        return new static(
            id: $request->id,
            post: $request->post,
        );
    }

    /**
     * @return string
     */
    public function getPost(): string
    {
        return $this->post;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
