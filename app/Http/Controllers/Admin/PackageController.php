<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\PackageService;
use DataTables;

class PackageController extends Controller
{
    protected $service;

	public function __construct(PackageService $service)
	{
		$this->service = $service;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->service->getAllLatest();
            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('service', function ($data){
                        return $data->service->service_type ?? "-";
                    })
                    ->editColumn('action', function ($data){
                        return $data->id;
                    })
                    ->make(true);
        }

        return view('admin.package_management.index');
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
        //
    }
}
