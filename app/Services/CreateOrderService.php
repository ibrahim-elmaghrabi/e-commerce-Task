<?php

namespace App\Services;

use Exceptions;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GenericException;
use App\Repositories\Contracts\StoreRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;

class CreateOrderService
{
    protected $storeRepository;

    protected $productRepository;

    public function __construct(StoreRepositoryContract $storeRepositoryContract,
                                ProductRepositoryContract $productRepositoryContract,
    )
    {
        $this->storeRepository = $storeRepositoryContract;
        $this->productRepository = $productRepositoryContract;
    }

    public function createOrder(array $data)
    {
    try{
        $store =  $this->storeRepository->find($data['store_id']);
        DB::transaction(function () use($store, $data) {
            $order = auth()->user()->orders()->create($data);
            $total = 0 ;
            $shippingCost = $store->shipping_cost;
            foreach ($data['products'] as $p)
            {
                $product = $this->productRepository->find($p['product_id']);
                $readyProduct = [
                    $p['product_id'] => [
                        'quantity' => $p['quantity'],
                        'price'    => $product->price,
                    ]
                ];
                $order->products()->attach($readyProduct);
                $total += $product->price * $p['quantity'];
            }
            $total = $total + $shippingCost ;
            if(! $store->vat_included)
            {
                $this->productNotIncludeVat($order, $total, $store->vat_percentage, $shippingCost);
                
            }else{
                    
                $this->productIncludeVat($order, $total, $shippingCost);
            }
        });
        }catch (\Exceptions $e){
            throw new GenericException;
        }
    
    }

     public function productIncludeVat($order, $total, $shippingCost)
    {
        $updatedOrder= $order->update([
                'total' => $total ,
                'shipping_cost' => $shippingCost,
            ]);
        if(! $updatedOrder)
        {
             $order->meals()->detach($readyMeal);
             $order->delete();
             throw new GenericException;
        }
         
    }

    public function productNotIncludeVat($order, $total, $vatPercentage, $shippingCost)
    {
        $vat = $vatPercentage * $total ;
        $total = $total - $vat ;
        $updatedOrder= $order->update([
            'total' => $total ,
            'shipping_cost' => $shippingCost,
            'vat' => $vat,
        ]);
         if(! $updatedOrder)
        {
             $order->meals()->detach($readyMeal);
             $order->delete();
             throw new GenericException;
        }
            
    }
 
}