<?php

namespace App\Actions\Post;

use App\Interfaces\Repositories\PostRepositoryInterface;

class DeletePostAction
{

    public function __construct(protected PostRepositoryInterface $postRepository)
    {
    }

    /**
     * @param int $id
     * @return void
     */
    public function execute(int $id): void
    {
        $this->postRepository->delete($id);
    }
}
