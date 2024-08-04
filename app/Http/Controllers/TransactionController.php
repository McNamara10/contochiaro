<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Models\Transaction;
use App\Interface\TransactionRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\TransactionResource;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    private TransactionRepositoryInterface $transactionRepositoryInterface;

    public function __construct(TransactionRepositoryInterface $transactionRepositoryInterface)
    {
        $this->transactionRepositoryInterface = $transactionRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = $this->transactionRepositoryInterface->index();

        return ApiResponseClass::sendResponse(TransactionResource::collection($data),'',200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request)
    {
        //
        $details =[
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => $request->date
        ];
        DB::beginTransaction();
        try{
             $transaction = $this->transactionRepositoryInterface->store($details);

             DB::commit();
             return ApiResponseClass::sendResponse(new TransactionResource($transaction),'Transaction Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $transaction = $this->transactionRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new TransactionResource($transaction),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, $id)
    {
        //
        $updateDetails =[
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => $request->date
        ];
        DB::beginTransaction();
        try{
             $product = $this->transactionRepositoryInterface->update($updateDetails,$id);

             DB::commit();
             return ApiResponseClass::sendResponse('Transaction Update Successful','',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $this->transactionRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Transaction Delete Successful','',204);
    }
}
