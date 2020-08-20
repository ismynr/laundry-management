<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\PackageRequest;
use App\Services\PackageService;
use App\Traits\ResponseAPI;
use App\Package;

class PackageApiController extends Controller
{
    use ResponseAPI;

    protected $service;

	public function __construct(PackageService $service)
	{
		$this->service = $service;
    }
    
    public function index()
    {
        $object = $this->service->getAllLatest();
        return $this->response("Show all data Package", $object);
    }

    public function create()
    {
        //
    }

    public function store(PackageRequest $request)
    {
        $object = $this->service->insert($request);
        return $this->response("Package has been Created", $object);
    }

    public function show($id)
    {
        $object = $this->service->getById($id);
        if(!$object){
            return $this->response("Package not found with ID $id", 404);
        }

        return $this->response(
            "Show Package detail", $object
        );
    }

    public function edit($id)
    {
        //
    }

    public function update(PackageRequest $request, $id)
    {
        $check = $this->service->getById($id);
        if(!$check){
            return $this->response("Package not found with ID $id", 404);
        }

        $object = $this->service->update($request, $id);
        return $this->success(
            "Package has been Updated", $request->all(), 200
        );
    }

    public function destroy($id)
    {
        $check = $this->service->getById($id);            
        if(!$check){
            return $this->response("Package not found with ID $id", 404);
        }

        $object = $this->service->delete($id);
        return $this->success(
            "Package has been Deleted", $check
        );
    }
}
