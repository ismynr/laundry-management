<?php

namespace App\Repositories;

use App\Interfaces\TransactionDetailRepositoryInterface;
use App\TransactionDetail;

class TransactionDetailRepository implements TransactionDetailRepositoryInterface
{
    public function getAllLatest()
    {
        return TransactionDetail::latest()->get();
    }

    public function getAll()
    {
        return TransactionDetail::all();
    }

    public function getBy($column, $data){
        return TransactionDetail::where($column, $data)->latest()->get();
    }
    
    public function getById($id)
    {
        return TransactionDetail::find($id);
    }

    public function store(array $data)
    {
        return TransactionDetail::create($data);
    }

    public function update(array $data, $id)
    {
        return TransactionDetail::find($id)->update($data);
    }

    public function destroy($id)
    {
        return TransactionDetail::destroy($id);
    }
}