<?php

namespace App\Repositories;

use App\Interfaces\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryInterface
{
    /**
     * @return Model
     */
    abstract public function getModel(): Model;

    /**
     * @return Builder
     */
    public function getQuery(): Builder
    {
        return $this->getModel()->newQuery();
    }

    /**
     * @param array|null $select
     * @param array|null $with
     * @return Collection
     */
    public function getAll(?array $select = ['*'], ?array $with = []): Collection
    {
        $query = $this->getQuery()->with($with)->select($select);

        return $query->get();
    }

    /**
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->getQuery()->create($data);
    }

    /**
     * @param int $id
     * @param array|null $with
     * @param array|null $select
     * @return Model|null
     */
    public function getById(int $id, ?array $with = [], ?array $select = ['*']): ?Model
    {
        $query = $this->getQuery()->select($select)->where('id', $id);

        if ($with) {
            $query->with($with);
        }

        return $query->firstOrFail();
    }

    /**
     * @param int $id
     * @param array $data
     * @return Model|null
     */
    public function updateById(int $id, array $data): ?Model
    {
        $model = $this->getById($id);
        $model->update($data);

        return $model;
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): ?bool
    {
        return $this->getQuery()->where('id', $id)->delete();
    }

    /**
     * @param int $userId
     * @return Collection|null
     */
    public function getByUserId(int $userId): ?Collection
    {
        return $this->getQuery()->where('user_id', $userId)->get();
    }

    /**
     * @param array $conditions
     * @param string $orderBy
     * @param bool $orderAsc
     * @param array|null $with
     * @param array|null $select
     * @return Model|null
     */
    public function findBy(array $conditions, string $orderBy = 'created_at', bool $orderAsc = true, ?array $with = null, ?array $select = ['*']): ?Model
    {
        $query = $this->getQuery()->select($select)->where($conditions);

        if ($with) {
            $query->with($with);
        }

        if ($orderAsc) {
            $query->orderBy($orderBy);
        } else {
            $query->orderBy($orderBy, 'desc');
        }

        return $query->first();
    }
}
