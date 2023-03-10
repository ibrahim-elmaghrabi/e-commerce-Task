<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\ProductRepositoryContract;

class ProductRepository extends BaseRepository implements ProductRepositoryContract
{
    public function __construct(Product $product)
    {
        $this->setModel($product);
    }

    
}