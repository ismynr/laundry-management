<?php 
namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\User;

class UserService
{
    protected $repo;

    public function __construct(UserRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAllLatest()
    {
        return $this->repo->getAllLatest();
    }

    public function getAllLatestAdmin()
    {
        return $this->repo->getAllLatestAdmin();
    }
    
    public function getAllLatestKaryawan()
    {
        return $this->repo->getAllLatestKaryawan();
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


