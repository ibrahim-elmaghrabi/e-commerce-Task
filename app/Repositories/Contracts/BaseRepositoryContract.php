<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryContract
{
   // public function all(): collection;
    public function find(int $id): ?Model;
    public function whereFirst(string $column,string $value): ?Model;
    public function create(array $data): ?Model;
    public function update(int $id, array $data): ?Model;
    public function delete(int $id): bool;
}