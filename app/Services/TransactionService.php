<?php 
namespace App\Services;

use App\Interfaces\TransactionRepositoryInterface;
use Illuminate\Http\Request;
use App\Transaction;

class TransactionService
{
    protected $repo;

    public function __construct(TransactionRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAllLatest()
    {
        return $this->repo->getAllLatest();
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function getBy($column, $data)
    {
        return $this->repo->getBy($column, $data);
    }

    public function getCountJoinTdBy($column, $id)
    {
        return $this->repo->getCountJoinTdBy($column, $id);
    }

    public function getTotalHargaById($id_transaction)
    {
        return $this->repo->getTotalHargaById($id_transaction);
    }
    
    public function getById($id)
    {
        return $this->repo->getById($id);
    }

    public function insert(array $data)
    {
        return $this->repo->store($data);
    }

    public function update(array $data, $id)
    {
        return $this->repo->update($data, $id);
    }

    public function delete($id)
    {
        return $this->repo->destroy($id);
    }
}


