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

    public function storeProducts(int $storeId)
    {
        return $this->getModel()->where('store_id', $storeId)->get();
    }
}