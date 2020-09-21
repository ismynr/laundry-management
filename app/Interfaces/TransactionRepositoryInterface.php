<?php

namespace App\Interfaces;

interface TransactionRepositoryInterface
{
    public function getAllLatest();

    public function getAllLatestLimit($limit);

    public function getAll();

    public function getBy($column, $data);

    public function getCountJoinTdBy($column, $id);

    public function getTotalHargaById($id_transaksi);

    public function getById($id);

    public function store(array $data);

    public function update(array $data, $id);

    public function destroy($id);
}