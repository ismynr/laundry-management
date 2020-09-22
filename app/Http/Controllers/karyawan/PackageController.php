<?php

namespace App\Http\Controllers\karyawan;

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
                    ->editColumn('harga', function($data){
                        return \FormatHelp::rupiah($data->harga);
                    })
                    ->editColumn('service', function ($data){
                        return $data->service->service_type ?? "-";
                    })
                    ->editColumn('action', function ($data){
                        return $data->id;
                    })
                    ->make(true);
        }
    }
}
