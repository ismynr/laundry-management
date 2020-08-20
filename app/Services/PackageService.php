<?php 
namespace App\Services;

use App\Interfaces\PackageRepositoryInterface;
use App\Http\Requests\PackageRequest;

use App\Package;
use Auth;

class PackageService
{
    protected $repo;

    public function __construct(PackageRepositoryInterface $repo)
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

    public function insert(PackageRequest $request)
    {
        return $this->repo->store($request->all());
    }

    public function update(PackageRequest $request, $id)
    {
        return $this->repo->update($request->all(), $id);
    }

    public function delete($id)
    {
        return $this->repo->destroy($id);
    }
}


