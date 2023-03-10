<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryContract
{
    public function all();
    public function find(int $id): ?Model;
    public function whereFirst(string $column,string $value): ?Model;
    public function whereGet(string $column, string $value);
    public function create(array $data): ?Model;
    public function update(int $id, array $data): ?Model;
    public function deleteById(int $id): bool;
    public function delete(): bool;

}