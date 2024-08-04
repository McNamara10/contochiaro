<?php

namespace App\Repositories;
use App\Models\Transaction;
use App\Interface\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function index(){
        return Transaction::all();
    }

    public function getById($id){
       return Transaction::findOrFail($id);
    }

    public function store(array $data){
       return Transaction::create($data);
    }

    public function update(array $data,$id){
       return Transaction::whereId($id)->update($data);
    }
    
    public function delete($id){
        Transaction::destroy($id);
    }
}
