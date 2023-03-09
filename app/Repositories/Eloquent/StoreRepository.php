<?php

namespace App\Repositories\Eloquent;

use App\Models\Store;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\StoreRepositoryContract;

class StoreRepository extends BaseRepository implements StoreRepositoryContract
{
    public function __construct(Store $store)
    {
        $this->setModel($store);
    }
}