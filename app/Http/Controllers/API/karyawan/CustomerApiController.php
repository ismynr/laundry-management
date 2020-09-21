<?php

namespace App\Http\Controllers\API\karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\CustomerRequest;
use App\Services\CustomerService;
use App\Traits\ResponseAPI;
use App\Customer;

class CustomerApiController extends Controller
{
    use ResponseAPI;

    protected $service;

    public function __construct(CustomerService $service)
	{
		$this->service = $service;
	}

    public function index()
    {
        $object = $this->service->getAllLatest();
        return $this->response("All Customer", $object);
    }

    public function create()
    {
        //
    }

    public function store(CustomerRequest $request)
    {
        $object = $this->service->insert($request);
        return $this->response(
            "Customer Inserted", $object, 201 
        );
    }

    public function show($id)
    {
        $object = $this->service->getById($id);
        if(!$object){
            return $this->response("No customer with ID $id", null, 404);
        }

        return $this->response(
            "Customer Detail", $object 
        );
    }

    public function edit($id)
    {
        //
    }

    public function update(CustomerRequest $request, $id)
    {
        $check = $this->service->getById($id);
        if(!$check){
            return $this->response("Customer not found with ID $id", null, 404);
        }

        $object = $this->service->update($request, $id);
        return $this->response(
            "Customer has been Updated", $request->all()
        );
    }

    public function destroy($id)
    {
        $check = $this->service->getById($id);            
        if(!$check){
            return $this->response("Customer not found with ID $id", null, 404);
        }

        $object = $this->service->delete($id);
        return $this->response(
            "Customer has been Deleted", $check
        );
    }

    public function loadDataSearchReq(Request $request)
    {
        $data = $this->service->loadSearchCustomerReq($request->q);
        return $this->response("Show customer By " . $request->q, $data);
    }
}
