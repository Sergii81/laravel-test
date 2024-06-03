<?php

namespace App\Actions\Post;

use App\Interfaces\Repositories\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GetAllPostsAction
{
    /**
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(
        protected PostRepositoryInterface $postRepository
    ) {
    }

    /**
     * @return Collection
     */
    public function execute(): Collection
    {
        return $this->postRepository->getAll();
    }
}
