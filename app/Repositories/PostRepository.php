<?php

namespace App\Repositories;

use App\Interfaces\Repositories\PostRepositoryInterface;
use App\Models\Post;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;

class PostRepository extends AbstractRepository implements PostRepositoryInterface
{
    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return new Post();
    }
}
