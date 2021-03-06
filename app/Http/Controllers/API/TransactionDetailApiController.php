<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\TransactionDetailRequest;
use App\Services\TransactionDetailService;
use App\Traits\ResponseAPI;
use App\TransactionDetail;
use Auth;

class TransactionDetailApiController extends Controller
{
    use ResponseAPI;

    protected $service;

    public function __construct(TransactionDetailService $service)
	{
        $this->service = $service;
    }

    public function index()
    {
        $object = $this->service->getAllLatest();
        return $this->response("All Transaction Details", $object);
    }

    public function create()
    {
        //
    }

    public function store(TransactionDetailRequest $request)
    {
        $object = $this->service->insert($request->all());
        return $this->response(
            "Service Inserted", $object, 201 
        );
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

    public function updateStatus(Request $request, $id){
        $check = $this->service->getById($id);
        if(!$check){
            return $this->response("No transaction detail with ID $id", null, 404);
        }

        $data = [
            'status' => $request->status
        ];

        $object = $this->service->update($data, $id);
        activity("transaction item")
            ->withProperties(["attributes" => $data,"old" => ['status' => $check->status]])
            ->performedOn($check)
            ->log(':causer.name has changed status of the transaction item to "'.$request->status.'"');
            
        return $this->response(
            "Transaction Detail Updated", $check, 200
        );
    }

    public function destroy($id)
    {
        $object = $this->service->delete($id);
        
        if(!$object){
            return $this->response("No transaction detail with ID $id", null, 404);        
        }

        return $this->response("Transaction Detail Deleted", $object);
    }

    public function destroyByIdTrans($id_transaction){
        $object = $this->service->getBy('id_transaction', $id_transaction);
        
        if(count($object) >= 1){
            // JADIKAN ARRAY UNTUK AMBIL SEMUA ID TRANSACTION DETAILNYA
            $arrayObj = [];
            foreach($object as $obj){
                $arrayObj[] = $obj->id;
            }

            if($object[0]->transaction->end_date != null){
                return $this->response("Cannot delete with ID ".$object[0]->id, null, 302);
            }
            
            $rem = $this->service->delete($arrayObj);
            return $this->response("Transaction Detail Deleted", $rem);
        }else{
            return $this->response("Transaction Detail Deleted");
        }
    }
}
