<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\KaryawanRequest;
use App\Services\KaryawanService;
use App\Traits\ResponseAPI;
use App\Karyawan;

class KaryawanApiController extends Controller
{
    use ResponseAPI;

    protected $service;

	public function __construct(KaryawanService $service)
	{
		$this->service = $service;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(KaryawanRequest $request)
    {
        $object = $this->service->insert($request->all());

        return $this->response(
            "Karyawan Inserted", $object, 201 
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

    public function update(KaryawanRequest $request, $id)
    {
        $check = $this->service->getById($id);
        if(!$check){
            return $this->response("No karyawan with ID $id", null, 404);
        }

        $object = $this->service->update($request->all(), $id);
        return $this->response(
            "Karyawan Updated", $check, 200
        );
    }

    public function destroy($id)
    {
        $object = $this->service->delete($id);
        
        if(!$object){
            return $this->response("No karyawan with ID $id", null, 404);        
        }

        return $this->response("Karyawan Deleted", $object);
    }
}
