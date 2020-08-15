<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ServiceRequest;
use App\Services\ServiceService;
use App\Service;
use DataTables;

class ServiceController extends Controller
{
    protected $service;

	public function __construct(ServiceService $service)
	{
		$this->service = $service;
    }
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->service->getAllLatest();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('action', function($data) {
                        return $data->id;
                    })
                    ->make(true);
        }

        return view('admin.service_management.index');
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

    public function update(ServiceRequest $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
