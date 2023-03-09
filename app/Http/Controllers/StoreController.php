<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use Symfony\Component\HttpFoundation\Response;
use App\Repositories\Contracts\StoreRepositoryContract;

class StoreController extends Controller
{
    protected $storeRepository;

    protected $userRepository;

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
        return httpResponse(1, 'Success', $stores);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $store= $this->storeRepository->create($request->validated()+['user_id' => auth()->user()->id]);
        return httpResponse(1, 'Success', $store);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $store = $this->storeRepository->find($id);
        return httpResponse(1, 'Success', $store);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, int $id)
    {
        $store = $this->storeRepository->find($id);
        if(! $store)
        {
             return response()->json([
                'status' => 'error',
                'error'  => 'notFound'
            ], Response::HTTP_NOT_FOUND);
        }
        if(! $store->user_id == auth()->user()->id)
        {
            return response()->json([
                'status' => 'error',
                'error'  => 'unauthorized'
            ], Response::HTTP_UNAUTHORIZED);
        }
            
         $store = $this->storeRepository->update($id, $request->validated());
         return httpResponse('1', 'Success', $store);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return $this->storeRepository->delete($id) ? httpResponse('0', 'Failed') : httpResponse('error', 'error happened please Try again');

    }
}
