<?php

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Transaction;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getAllLatest()
    {
        return Transaction::latest()->get();
    }

    public function getAllLatestLimit($limit)
    {
        return Transaction::latest()->limit($limit)->get();
    }

    public function getAll()
    {
        return Transaction::all();
    }

    public function getBy($column, $data){
        return Transaction::where($column, $data)->get();
    }

    public function getCountJoinTdBy($column, $id){
        return Transaction::where($column, $id)
                    ->join('transaction_details', 'transactions.id', '=', 'transaction_details.id_transaction')
                    ->count();
    }

    public function getTotalHargaById($id_transaksi){
        $query = Transaction::select(\DB::raw('SUM(transaction_details.harga) as total'))
                    ->where("transactions.id", $id_transaksi)
                    ->join('transaction_details', 'transactions.id', '=', 'transaction_details.id_transaction')
                    ->groupBy('transactions.id')
                    ->get()->toArray();
        return $query;
    }

    public function getById($id)
    {
        return Transaction::find($id);
    }

    public function store(array $data)
    {
        return Transaction::create($data);
    }

    public function update(array $data, $id)
    {
        return Transaction::find($id)->update($data);
    }

    public function destroy($id)
    {
        return Transaction::destroy($id);
    }
}