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
        $object = $this->service->getAllLatest();
        return $this->response("All Services", $object);
    }

    public function create()
    {
        //
    }

    public function store(ServiceRequest $request)
    {
        $object = $this->service->insert($request->all());
        return $this->response(
            "Service Inserted", $object, 201 
        );
    }

    public function show($id)
    {
        $object = $this->service->getById($id);
        if(!$object){
            return $this->response("No service with ID $id", null, 404);
        }

        return $this->response(
            "Service Detail", $object 
        );
    }

    public function edit($id)
    {
        //
    }

    public function update(ServiceRequest $request, $id)
    {
        $check = $this->service->getById($id);
        if(!$check){
            return $this->response("No service with ID $id", null, 404);
        }

        $object = $this->service->update($request->all(), $id);
        return $this->response(
            "Service Updated", $check, 200
        );
    }

    public function destroy($id)
    {
        $object = $this->service->delete($id);
        if(!$object){
            return $this->response("No service with ID $id", null, 404);        
        }

        return $this->response("Service Deleted", $object);
    }

    public function loadDataSearchReq(Request $request)
    {
        $data = $this->service->loadSearchServiceReq($request->q);
        return $this->response("Show service By " . $request->q, $data);
    }
}
