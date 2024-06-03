<?php

namespace App\Actions\Post;

use App\Interfaces\Repositories\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class GetPostAction
{

    public function __construct(protected PostRepositoryInterface $postRepository)
    {
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function execute(int $id): ?Model
    {
        return $this->postRepository->getById($id);
    }
}
