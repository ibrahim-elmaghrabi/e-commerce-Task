<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use App\Services\CreateOrderService;
use App\Http\Resources\OrderResource;
use App\Repositories\Contracts\OrderRepositoryContract;

class OrderController extends Controller
{

    protected $orderService ;

    protected $orderRepository;
    
    public function __construct(CreateOrderService $createOrderService, OrderRepositoryContract $orderRepositoryContract)
    {
        $this->orderService = $createOrderService ;
        $this->orderRepository = $orderRepositoryContract;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders= $this->orderRepository->getWhere('user_id', auth()->user()->id);
        return httpResponse(1, 'Success', OrderResource::collection($orders));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
         return $this->orderService->createOrder($request->validated());
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $order = $this->orderRepository->find($id);
        if($order->user_id != auth()->user()->id)
        {
            return httpResponse(0, 'unauthorized');
        }
        return httpResponse(1, 'Success', new OrderResource($order));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
