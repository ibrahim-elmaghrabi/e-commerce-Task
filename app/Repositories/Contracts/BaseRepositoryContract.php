<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface BaseRepositoryContract
{
    public function all(): ?Collection;
    public function find(int $id): ?Model;
    public function whereFirst(string $column,string $value): ?Model;
    public function getWhere(string $column, string $value): ?Collection;
    public function create(array $data): ?Model;
    public function update(int $id, array $data): ?Model;
    public function deleteById(int $id): bool;
    public function delete(): bool;

}