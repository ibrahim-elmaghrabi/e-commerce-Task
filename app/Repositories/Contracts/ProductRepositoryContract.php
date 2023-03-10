<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryContract
{
    public function storeProducts(int $storeId);
}