<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ServiceRequest;
use App\Services\ServiceService;
use App\Traits\ResponseAPI;
use App\Service;

class ServiceApiController extends Controller
{
    use ResponseAPI;

    protected $service;

	public function __construct(ServiceService $service)
	{
		$this->service = $service;
	}
    
    public function index()
    {
        try {
            $object = $this->service->getAllLatest();
            return $this->success("All Services", $object);
        } catch(Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function create()
    {
        //
    }

    public function store(ServiceRequest $request)
    {
        try {
            $object = $this->service->insert($request->all());

            return $this->success(
                "Service Inserted", $object, 201 
            );
        } catch(Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function show($id)
    {
        try {
            $object = $this->service->getById($id);

            if(!$object){
                return $this->error("No service with ID $id", 404);
            }

            return $this->success(
                "Service Detail", $object 
            );
        } catch(Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(ServiceRequest $request, $id)
    {
        try {
            $check = $this->service->getById($id);

            if(!$check){
                return $this->error("No service with ID $id", 404);
            }

            $object = $this->service->update($request->all(), $id);

            return $this->success(
                "Service Updated", $check, 200
            );
        } catch(Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function destroy($id)
    {
        try {
            $object = $this->service->delete($id);
            
            if(!$object){
                return $this->error("No service with ID $id", 404);
            }

            return $this->success("Service Deleted", $object);
        } catch(Exception $e) {
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}
