<?php

namespace App\Actions\Post;

use App\DTOs\PostStoreDto;
use App\Interfaces\Repositories\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class StorePostAction
{
    /**
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(protected PostRepositoryInterface $postRepository)
    {
    }

    /**
     * @param PostStoreDto $dto
     * @return Model
     */
    public function execute(PostStoreDto $dto): Model
    {
        return $this->postRepository->create($dto->toArray());
    }
}
