<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Repositories\Contracts\StoreRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;

class ProductController extends Controller
{
    protected $productRepository ;

    protected $storeRepository;

    public function __construct(ProductRepositoryContract $productRepositoryContract, StoreRepositoryContract $storeRepositoryContract)
    {
        $this->productRepository = $productRepositoryContract ;
        $this->storeRepository = $storeRepositoryContract;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productRepository->all();
        return httpResponse(1, "Success", ProductResource::collection($products));
    }

    public function productsByStore($storeId)
    {
        $products = $this->productRepository->whereGet('store_id', $storeId);
        return httpResponse(1, 'Success', ProductResource::collection($products));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $store = $this->storeRepository->find($request['store_id']);
        if($store->user->id != auth()->user()->id){
            return httpResponse(0, 'unauthorized');
        }
        $product = $this->productRepository->create($request->validated());
        return httpResponse(1, "Success", $product);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $product = $this->productRepository->find($id);
        return httpResponse(1, "Success", new ProductResource($product));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, int $id)
    {
        $product = $this->productRepository->find($id);
        if($product->store->user->id != auth()->user()->id){
            return httpResponse(0, 'unauthorized');
        }
         $product =$this->productRepository->update($id, $request->validated());
         return httpResponse(1, 'Success', $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $product = $this->productRepository->find($id);
        if($product->store->user->id != auth()->user()->id)
        {
            return httpResponse(0, 'unauthorized');
        }
        $product->delete();
        return httpResponse(1, 'Success');
    }
}
