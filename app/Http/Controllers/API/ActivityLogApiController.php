<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\ActivityLogService;
use App\Traits\ResponseAPI;
use App\ActivityLog;

class ActivityLogApiController extends Controller
{
    use ResponseAPI;

    protected $service;

	public function __construct(ActivityLogService $service)
	{
		$this->service = $service;
	}
    
    public function index()
    {
        $object = $this->service->getAllLatest();
        return $this->response("All Activity Log", $object);
    }

    public function show($id){
        $object = $this->service->getById($id);
        if(!$object){
            return $this->response("No activity log with ID $id", null, 404);
        }

        return $this->response(
            "Activity Log Detail", $object 
        );
    }
}
