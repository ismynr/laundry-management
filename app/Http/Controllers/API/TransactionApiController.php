<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\TransactionRequest;
use App\Services\TransactionService;
use App\Traits\ResponseAPI;
use App\Transaction;

class TransactionApiController extends Controller
{
    use ResponseAPI;

    protected $service;

	public function __construct(TransactionService $service)
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

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $object = $this->service->delete($id);
        
        if(!$object){
            return $this->response("No transaction with ID $id", null, 404);        
        }

        return $this->response("Transaction Deleted", $object);
    }
}
