<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\StoreResource;
use App\Repositories\Contracts\StoreRepositoryContract;

class StoreController extends Controller
{
    protected $storeRepository;

    public function __construct(StoreRepositoryContract $storeRepositoryContract)
    {
        $this->storeRepository = $storeRepositoryContract ;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = $this->storeRepository->all();
        return httpResponse(1, 'Success', StoreResource::collection($stores));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $store= $this->storeRepository->create($request->validated()+['user_id' => auth()->user()->id]);
        return httpResponse(1, 'Success', new StoreResource($store));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $store = $this->storeRepository->find($id);
        return httpResponse(1, 'Success', new StoreResource($store));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, int $id)
    {
        $store = $this->storeRepository->find($id);
         
        if($store->user_id != auth()->user()->id)
        {
             return httpResponse(0, 'unauthorized');
        }
         $store = $this->storeRepository->update($id, $request->validated());
         return httpResponse('1', 'Success', new StoreResource($store));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $store = $this->storeRepository->find($id);
         if($store->user_id != auth()->user()->id)
        {
             return httpResponse(0, 'unauthorized');
        }
        $store->delete();
        return httpResponse(1, 'Success');
    }
}
