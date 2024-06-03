<?php

namespace App\Actions\Post;

use App\DTOs\PostUpdateDto;
use App\Interfaces\Repositories\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UpdatePostAction
{
    /**
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(protected PostRepositoryInterface $postRepository)
    {
    }

    /**
     * @param PostUpdateDto $dto
     * @return Model|null
     */
    public function execute(PostUpdateDto $dto): ?Model
    {
        return $this->postRepository->updateById(
            $dto->getId(),
            ['post' => $dto->getPost()]
        );
    }
}
