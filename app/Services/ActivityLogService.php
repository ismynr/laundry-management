<?php 
namespace App\Services;

use App\Interfaces\ActivityLogRepositoryInterface;

use App\ActivityLog;
use Auth;

class ActivityLogService
{
    protected $repo;

    public function __construct(ActivityLogRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function getAllLatest()
    {
        return $this->repo->getAllLatest();
    }

    public function getAllLatestLimit($limit)
    {
        return $this->repo->getAllLatestLimit($limit);
    }

    public function getById($id)
    {
        return $this->repo->getById($id);
    }
}


