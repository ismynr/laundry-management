<?php 
namespace App\Services;

use App\Interfaces\CustomerRepositoryInterface;
use App\Http\Requests\CustomerRequest;

use App\Customer;
use Auth;

class CustomerService
{
    protected $repo;

    public function __construct(CustomerRepositoryInterface $repo)
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
    
    public function getById($id)
    {
        return $this->repo->getById($id);
    }

    public function insert(CustomerRequest $request)
    {
        return $this->repo->store($request->all());
    }

    public function update(CustomerRequest $request, $id)
    {
        return $this->repo->update($request->all(), $id);
    }

    public function delete($id)
    {
        return $this->repo->destroy($id);
    }
}


