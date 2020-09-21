<?php

namespace App\Http\Controllers\API\karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ExpanseRequest;
use App\Services\ExpanseService;
use App\Traits\ResponseAPI;
use App\Expanse;
use Auth;

class ExpanseApiController extends Controller
{
    use ResponseAPI;

    protected $service;

	public function __construct(ExpanseService $service)
	{
		$this->service = $service;
    }

    public function index()
    {
        $object = $this->service->getAllLatest();
        return $this->response("Show all data Expanse", $object);
    }

    public function create()
    {
        //
    }

    public function store(ExpanseRequest $request)
    {
        $object = $this->service->insert($request);
        return $this->response("Expanse has been Created", $object);
    }

    public function show($id)
    {
        $object = $this->service->getById($id);
        if(!$object){
            return $this->response("Expanse not found with ID $id", null, 404);
        }

        return $this->response(
            "Show Expanse detail", $object
        );
    }

    public function edit($id)
    {
        //
    }

    public function update(ExpanseRequest $request, $id)
    {
        $check = $this->service->getById($id);
        if(!$check){
            return $this->response("Expanse not found with ID $id", null, 404);
        }

        if($check->id_user != Auth::user()->id){
            return $this->response("You have no right to change this expanse", null, 401);
        }
        
        $object = $this->service->update($request, $id);
        return $this->response(
            "Expanse has been Updated", $request->all()
        );
    }

    public function destroy($id)
    {
        $check = $this->service->getById($id);            
        if(!$check){
            return $this->response("Expanse not found with ID $id", null, 404);
        }

        if($check->id_user != Auth::user()->id){
            return $this->response("You have no right to delete this expanse", null, 401);;
        }

        $object = $this->service->delete($id);
        return $this->response(
            "Expanse has been Deleted", $check
        );
    }
}
