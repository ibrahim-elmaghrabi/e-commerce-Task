<?php

namespace App\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Contracts\BaseRepositoryContract;

class BaseRepository implements BaseRepositoryContract
{
    private Model $model;

     public function all()
    {
        return $this->model->get();
    }

    public function find($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

     public function whereFirst(string $column,string $value): ?Model
     {
        return $this->model->where($column, $value)->first();
     }

    public function create(array $data): ?Model
    {
         $model= $this->model->create($data);
         return $model->fresh();
    }

    public function update(int $id, array $data): ?Model
    {
        $model = $this->find($id);
        $model->update($data);
        return $model->fresh();
    }

    public function deleteById(int $id): bool
    {
        return $this->find($id)->delete();
    }

    public function delete(): bool
    {
        return $this->model->delete();
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function setModel(Model $model): void
    {
        $this->model= $model;
    }
}