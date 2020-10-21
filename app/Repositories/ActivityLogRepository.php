<?php

namespace App\Repositories;

use App\Interfaces\ActivityLogRepositoryInterface;
use App\ActivityLog;

class ActivityLogRepository implements ActivityLogRepositoryInterface
{
    public function getAllLatest()
    {
        return ActivityLog::latest()->get();
    }

    public function getAllLatestLimit($limit)
    {
        return ActivityLog::latest()->limit($limit)->get();
    }

    public function getById($id)
    {
        return ActivityLog::find($id);
    }
}