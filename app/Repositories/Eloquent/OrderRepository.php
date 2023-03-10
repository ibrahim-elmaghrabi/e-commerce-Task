<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\OrderRepositoryContract;

class OrderRepository extends BaseRepository implements OrderRepositoryContract
{
    public function __construct(Order $order)
    {
        $this->setModel($order);
    }
}