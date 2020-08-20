<?php 
namespace App\Services;

use App\Interfaces\ExpanseRepositoryInterface;
use App\Http\Requests\ExpanseRequest;

use App\Expanse;
use Auth;

class ExpanseService
{
    protected $repo;

    public function __construct(ExpanseRepositoryInterface $repo)
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

    public function insert(ExpanseRequest $request)
    {
        return $this->repo->store($request->all());
    }

    public function update(ExpanseRequest $request, $id)
    {
        return $this->repo->update($request->all(), $id);
    }

    public function delete($id)
    {
        return $this->repo->destroy($id);
    }
}


